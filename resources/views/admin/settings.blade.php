@extends('layouts.admin')

@section('title', 'Site Ayarları - Admin Panel')
@section('page-title', 'Site Ayarları')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-xl p-8 shadow-sm border-2 border-eva-gold/20">
        <div class="flex items-center gap-3 mb-8">
            <div class="w-10 h-1 bg-eva-gold"></div>
            <h2 class="font-heading font-semibold text-2xl text-eva-heading">Genel Ayarlar</h2>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-6">
                <!-- Site Title -->
                <div>
                    <label class="block text-sm font-medium text-eva-charcoal mb-2">Site Başlığı</label>
                    <input type="text" name="site_title" value="{{ $settings['site_title'] ?? 'EVA HOME' }}"
                           class="w-full px-4 py-3 border-2 border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold focus:border-eva-gold">
                </div>

                <!-- Site Description -->
                <div>
                    <label class="block text-sm font-medium text-eva-charcoal mb-2">Site Açıklaması</label>
                    <textarea name="site_description" rows="3"
                              class="w-full px-4 py-3 border-2 border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold focus:border-eva-gold">{{ $settings['site_description'] ?? '' }}</textarea>
                </div>

                <!-- Contact Email -->
                <div>
                    <label class="block text-sm font-medium text-eva-charcoal mb-2">İletişim E-posta</label>
                    <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? 'info@evahome.com' }}"
                           class="w-full px-4 py-3 border-2 border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold focus:border-eva-gold">
                </div>

                <!-- Contact Phone -->
                <div>
                    <label class="block text-sm font-medium text-eva-charcoal mb-2">İletişim Telefon</label>
                    <input type="text" name="contact_phone" value="{{ $settings['contact_phone'] ?? '0850 123 45 67' }}"
                           class="w-full px-4 py-3 border-2 border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold focus:border-eva-gold">
                </div>

                <!-- Address -->
                <div>
                    <label class="block text-sm font-medium text-eva-charcoal mb-2">Adres</label>
                    <textarea name="address" rows="2"
                              class="w-full px-4 py-3 border-2 border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold focus:border-eva-gold">{{ $settings['address'] ?? '' }}</textarea>
                </div>

                <!-- Shipping Cost -->
                <div>
                    <label class="block text-sm font-medium text-eva-charcoal mb-2">Kargo Ücreti (₺)</label>
                    <input type="number" name="shipping_cost" value="{{ $settings['shipping_cost'] ?? '0' }}" step="0.01"
                           class="w-full px-4 py-3 border-2 border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold focus:border-eva-gold">
                </div>

                <!-- Free Shipping Threshold -->
                <div>
                    <label class="block text-sm font-medium text-eva-charcoal mb-2">Ücretsiz Kargo Limiti (₺)</label>
                    <input type="number" name="free_shipping_threshold" value="{{ $settings['free_shipping_threshold'] ?? '500' }}" step="0.01"
                           class="w-full px-4 py-3 border-2 border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold focus:border-eva-gold">
                </div>

                <!-- Social Media -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-eva-charcoal mb-2">Instagram</label>
                        <input type="url" name="instagram_url" value="{{ $settings['instagram_url'] ?? '' }}"
                               class="w-full px-4 py-3 border-2 border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold focus:border-eva-gold">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-eva-charcoal mb-2">Facebook</label>
                        <input type="url" name="facebook_url" value="{{ $settings['facebook_url'] ?? '' }}"
                               class="w-full px-4 py-3 border-2 border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold focus:border-eva-gold">
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-eva-silver/30 flex justify-end gap-4">
                <button type="submit" 
                        class="btn-text bg-eva-gold hover:bg-eva-charcoal text-white px-8 py-3 rounded-lg transition-all shadow-sm">
                    Kaydet
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

