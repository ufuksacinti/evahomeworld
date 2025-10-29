<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    /**
     * Process payment with Iyzico
     */
    public function processIyzicoPayment(Order $order, array $billingData, array $shippingData)
    {
        try {
            // Iyzico API configuration
            $options = new \Iyzipay\Options();
            $options->setApiKey(config('services.iyzico.api_key'));
            $options->setSecretKey(config('services.iyzico.secret_key'));
            $options->setBaseUrl(config('services.iyzico.base_url'));

            // Create payment request
            $request = new \Iyzipay\Request\CreatePaymentRequest();
            $request->setLocale(\Iyzipay\Model\Locale::TR);
            $request->setConversationId($order->order_number);
            $request->setPrice($order->total_amount);
            $request->setPaidPrice($order->getGrandTotal());
            $request->setCurrency(\Iyzipay\Model\Currency::TL);
            $request->setInstallment(1);
            $request->setBasketId($order->id);
            $request->setPaymentChannel(\Iyzipay\Model\PaymentChannel::WEB);
            $request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);

            // Card information
            $paymentCard = new \Iyzipay\Model\PaymentCard();
            $paymentCard->setCardHolderName($billingData['card_holder_name']);
            $paymentCard->setCardNumber($billingData['card_number']);
            $paymentCard->setExpireMonth($billingData['expire_month']);
            $paymentCard->setExpireYear($billingData['expire_year']);
            $paymentCard->setCvc($billingData['cvc']);
            $paymentCard->setRegisterCard(0);
            $request->setPaymentCard($paymentCard);

            // Buyer information
            $buyer = new \Iyzipay\Model\Buyer();
            $buyer->setId($order->user_id);
            $buyer->setName($order->user->name);
            $buyer->setSurname('');
            $buyer->setGsmNumber($billingData['phone'] ?? '');
            $buyer->setEmail($order->user->email);
            $buyer->setIdentityNumber('11111111111'); // TC kimlik no (test için)
            $buyer->setRegistrationAddress($billingData['address']);
            $buyer->setIp(request()->ip());
            $buyer->setCity($billingData['city']);
            $buyer->setCountry('Turkey');
            $buyer->setZipCode($billingData['zip_code'] ?? '34000');
            $request->setBuyer($buyer);

            // Shipping address
            $shippingAddress = new \Iyzipay\Model\Address();
            $shippingAddress->setContactName($shippingData['name']);
            $shippingAddress->setCity($shippingData['city']);
            $shippingAddress->setCountry('Turkey');
            $shippingAddress->setAddress($shippingData['address']);
            $shippingAddress->setZipCode($shippingData['zip_code'] ?? '34000');
            $request->setShippingAddress($shippingAddress);

            // Billing address
            $billingAddress = new \Iyzipay\Model\Address();
            $billingAddress->setContactName($billingData['name']);
            $billingAddress->setCity($billingData['city']);
            $billingAddress->setCountry('Turkey');
            $billingAddress->setAddress($billingData['address']);
            $billingAddress->setZipCode($billingData['zip_code'] ?? '34000');
            $request->setBillingAddress($billingAddress);

            // Basket items
            $basketItems = [];
            foreach ($order->items as $index => $item) {
                $basketItem = new \Iyzipay\Model\BasketItem();
                $basketItem->setId($item->product_id);
                $basketItem->setName($item->product_name);
                $basketItem->setCategory1('Genel');
                $basketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
                $basketItem->setPrice($item->total);
                $basketItems[] = $basketItem;
            }
            $request->setBasketItems($basketItems);

            // Make payment
            $payment = \Iyzipay\Model\Payment::create($request, $options);

            // Log the response
            Log::channel('payment')->info('Iyzico Payment Response', [
                'order_id' => $order->id,
                'status' => $payment->getStatus(),
                'payment_id' => $payment->getPaymentId(),
            ]);

            return [
                'success' => $payment->getStatus() === 'success',
                'payment' => $payment,
                'error' => $payment->getErrorMessage(),
            ];
        } catch (\Exception $e) {
            Log::channel('payment')->error('Iyzico Payment Error', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Process payment with Shopier
     */
    public function processShopierPayment(Order $order)
    {
        try {
            // Shopier API configuration
            $apiKey = config('services.shopier.api_key');
            $apiSecret = config('services.shopier.api_secret');

            $data = [
                'API_key' => $apiKey,
                'website_index' => 1,
                'platform_order_id' => $order->order_number,
                'product_name' => 'Sipariş #' . $order->order_number,
                'product_type' => 0, // 0: Physical
                'buyer_name' => $order->user->name,
                'buyer_email' => $order->user->email,
                'buyer_phone' => $order->shipping_address['phone'] ?? '',
                'buyer_account_age' => 0,
                'buyer_id_nr' => '',
                'buyer_address' => $order->shipping_address['address'],
                'buyer_city' => $order->shipping_address['city'],
                'buyer_country' => 'Türkiye',
                'buyer_postcode' => $order->shipping_address['zip_code'] ?? '',
                'shipping_address' => $order->shipping_address['address'],
                'shipping_city' => $order->shipping_address['city'],
                'shipping_country' => 'Türkiye',
                'shipping_postcode' => $order->shipping_address['zip_code'] ?? '',
                'total_order_value' => $order->getGrandTotal(),
                'currency' => 'TL',
                'platform' => 1,
                'is_in_frame' => 0,
                'current_language' => 'tr',
                'modul_version' => '1.0.0',
                'random_nr' => uniqid(),
            ];

            // Generate signature
            $signatureData = implode('', [
                $data['random_nr'],
                $data['platform_order_id'],
                $data['total_order_value'],
                $data['currency']
            ]);
            $data['signature'] = hash_hmac('sha256', $signatureData, $apiSecret);

            // Shopier payment URL
            $paymentUrl = 'https://www.shopier.com/ShowProduct/api_pay4.php?' . http_build_query($data);

            Log::channel('payment')->info('Shopier Payment URL Generated', [
                'order_id' => $order->id,
                'url' => $paymentUrl,
            ]);

            return [
                'success' => true,
                'payment_url' => $paymentUrl,
            ];
        } catch (\Exception $e) {
            Log::channel('payment')->error('Shopier Payment Error', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Verify payment callback from Iyzico
     */
    public function verifyIyzicoCallback($token)
    {
        try {
            $options = new \Iyzipay\Options();
            $options->setApiKey(config('services.iyzico.api_key'));
            $options->setSecretKey(config('services.iyzico.secret_key'));
            $options->setBaseUrl(config('services.iyzico.base_url'));

            $request = new \Iyzipay\Request\RetrievePaymentRequest();
            $request->setPaymentId($token);

            $payment = \Iyzipay\Model\Payment::retrieve($request, $options);

            return [
                'success' => $payment->getStatus() === 'success',
                'payment' => $payment,
            ];
        } catch (\Exception $e) {
            Log::channel('payment')->error('Iyzico Callback Error', [
                'token' => $token,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Verify payment callback from Shopier
     */
    public function verifyShopierCallback(array $data)
    {
        try {
            $apiSecret = config('services.shopier.api_secret');
            
            // Verify signature
            $signatureData = implode('', [
                $data['random_nr'] ?? '',
                $data['platform_order_id'] ?? '',
                $data['total_order_value'] ?? '',
                $data['currency'] ?? ''
            ]);
            
            $expectedSignature = hash_hmac('sha256', $signatureData, $apiSecret);
            
            if ($expectedSignature !== ($data['signature'] ?? '')) {
                return [
                    'success' => false,
                    'error' => 'Invalid signature',
                ];
            }

            return [
                'success' => $data['status'] === 'success',
                'data' => $data,
            ];
        } catch (\Exception $e) {
            Log::channel('payment')->error('Shopier Callback Error', [
                'data' => $data,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }
}

