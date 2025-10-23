@extends('layouts.main')

@section('title', 'Hakkımızda - EVA HOME')

@section('content')
<!-- Hero Section -->
<section class="relative bg-white py-20 border-b-2 border-eva-gold/20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <!-- Wax Seal -->
        <x-wax-seal type="gold" size="2xl" class="mx-auto mb-8" />
        
        <x-heading level="1" class="mb-6">
            Kalite Sözümüzdür
        </x-heading>
        
        <p class="text-xl text-eva-text leading-relaxed">
            2010'dan beri el yapımı, doğal ve premium ürünler üretiyoruz. 
            Her ürünümüz özenle seçilmiş malzemelerden, ustalarımızın mahir elleriyle hayat buluyor.
        </p>
    </div>
</section>

<!-- Our Story -->
<section class="py-16 bg-eva-soft-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="w-16 h-1 bg-eva-gold mb-6"></div>
                <x-heading level="2" class="mb-6">
                    Hikayemiz
                </x-heading>
                <div class="space-y-4 text-lg text-eva-text leading-relaxed">
                    <p>
                        EVA HOME, 2010 yılında İstanbul'da küçük bir atölyede başlayan bir tutku projesi olarak hayata başladı. 
                        Kurucu ekibimiz, evlere sadece mobilya değil, ruh ve enerji katmak isteyen idealist bir grup tasarımcıdan oluşuyordu.
                    </p>
                    <p>
                        Bugün, 8 farklı enerji koleksiyonu ve yüzlerce özel tasarım ürünümüzle binlerce eve dokunuyor, 
                        yaşam alanlarına estetik ve huzur getiriyoruz.
                    </p>
                    <p>
                        Her ürünümüz, doğal malzemelerden el işçiliğiyle üretilir ve balmumu mührümüzle garantilenir.
                    </p>
                </div>
            </div>
            
            <div class="relative">
                <div class="aspect-square bg-gradient-to-br rounded-2xl shadow-2xl flex items-center justify-center"
                     style="background: linear-gradient(135deg, var(--color-jasmine) 0%, var(--color-lavender) 100%);">
                    <x-wax-seal type="gold" size="2xl" class="opacity-30" />
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Values -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="w-24 h-1 bg-eva-gold mx-auto mb-6"></div>
            <x-heading level="2" class="mb-4">
                Değerlerimiz
            </x-heading>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- El İşçiliği -->
            <div class="text-center p-8 bg-eva-soft-white rounded-xl border-2 border-eva-gold/20 hover:border-eva-gold/40 transition-all">
                <x-wax-seal type="bronze" size="lg" class="mx-auto mb-6" />
                <h3 class="font-heading font-semibold text-xl text-eva-heading mb-3">
                    El İşçiliği
                </h3>
                <p class="text-eva-text leading-relaxed">
                    Her ürünümüz deneyimli ustalarımız tarafından özenle el yapımıdır. 
                    Seri üretim yapmıyoruz, her parça özgün ve özeldir.
                </p>
            </div>
            
            <!-- Doğal Malzeme -->
            <div class="text-center p-8 bg-eva-soft-white rounded-xl border-2 border-eva-gold/20 hover:border-eva-gold/40 transition-all">
                <x-wax-seal type="gold" size="lg" class="mx-auto mb-6" />
                <h3 class="font-heading font-semibold text-xl text-eva-heading mb-3">
                    %100 Doğal
                </h3>
                <p class="text-eva-text leading-relaxed">
                    Sadece doğal malzemeler kullanıyoruz. Balmumu, prinç, seramik, cam - 
                    hepsi doğadan geliyor, doğaya dönüyor.
                </p>
            </div>
            
            <!-- Premium Kalite -->
            <div class="text-center p-8 bg-eva-soft-white rounded-xl border-2 border-eva-gold/20 hover:border-eva-gold/40 transition-all">
                <x-wax-seal type="silver" size="lg" class="mx-auto mb-6" />
                <h3 class="font-heading font-semibold text-xl text-eva-heading mb-3">
                    Premium Kalite
                </h3>
                <p class="text-eva-text leading-relaxed">
                    Her ürün kalite kontrolünden geçer ve balmumu mührümüzle garantilenir. 
                    Ömür boyu kalite sözümüz vardır.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Our Team / Stats -->
<section class="py-16 bg-eva-charcoal text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <p class="text-5xl font-heading font-bold text-eva-gold mb-2 tabular-nums">14</p>
                <p class="text-eva-silver uppercase tracking-wider text-sm">Yıllık Deneyim</p>
            </div>
            <div>
                <p class="text-5xl font-heading font-bold text-eva-gold mb-2 tabular-nums">8</p>
                <p class="text-eva-silver uppercase tracking-wider text-sm">Enerji Koleksiyonu</p>
            </div>
            <div>
                <p class="text-5xl font-heading font-bold text-eva-gold mb-2 tabular-nums">500+</p>
                <p class="text-eva-silver uppercase tracking-wider text-sm">Tasarım</p>
            </div>
            <div>
                <p class="text-5xl font-heading font-bold text-eva-gold mb-2">%100</p>
                <p class="text-eva-silver uppercase tracking-wider text-sm">El Yapımı</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <x-heading level="2" class="mb-6">
            Bizimle İletişime Geçin
        </x-heading>
        <p class="text-lg text-eva-text mb-8">
            Sorularınız mı var? Özel tasarım mı istiyorsunuz? Size yardımcı olmaktan mutluluk duyarız.
        </p>
        <a href="{{ route('contact') }}" 
           class="inline-flex items-center gap-2 btn-text bg-eva-gold hover:bg-eva-charcoal text-white px-8 py-4 rounded-lg transition-all duration-300 shadow-lg">
            <span>İletişime Geçin</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
        </a>
    </div>
</section>
@endsection

