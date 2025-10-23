@extends('layouts.main')

@section('title', 'İletişim - EVA HOME')

@section('content')
<!-- Hero Section -->
<section class="relative bg-white py-16 border-b border-eva-silver/30">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="w-24 h-1 bg-eva-gold mx-auto mb-6"></div>
        
        <x-heading level="1" class="mb-6">
            İletişime Geçin
        </x-heading>
        
        <p class="text-xl text-eva-text">
            Sorularınız, önerileriniz veya özel tasarım talepleriniz için bizimle iletişime geçebilirsiniz
        </p>
    </div>
</section>

<!-- Contact Form & Info -->
<section class="py-16 bg-eva-soft-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="bg-white rounded-2xl p-8 shadow-lg border-2 border-eva-gold/20">
                <x-heading level="3" class="mb-6">
                    Mesaj Gönderin
                </x-heading>
                
                @if (session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-lg mb-6">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-lg mb-6">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-medium text-eva-charcoal mb-2">Adınız Soyadınız *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               class="w-full px-4 py-3 border-2 border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold focus:border-eva-gold transition-all">
                    </div>
                    
                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-eva-charcoal mb-2">E-posta Adresiniz *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full px-4 py-3 border-2 border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold focus:border-eva-gold transition-all">
                    </div>
                    
                    <!-- Subject -->
                    <div>
                        <label class="block text-sm font-medium text-eva-charcoal mb-2">Konu *</label>
                        <input type="text" name="subject" value="{{ old('subject') }}" required
                               class="w-full px-4 py-3 border-2 border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold focus:border-eva-gold transition-all">
                    </div>
                    
                    <!-- Message -->
                    <div>
                        <label class="block text-sm font-medium text-eva-charcoal mb-2">Mesajınız *</label>
                        <textarea name="message" rows="6" required
                                  class="w-full px-4 py-3 border-2 border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold focus:border-eva-gold transition-all">{{ old('message') }}</textarea>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full btn-text bg-eva-gold hover:bg-eva-charcoal text-white px-8 py-4 rounded-lg transition-all duration-300 shadow-lg flex items-center justify-center gap-2">
                        <span>Mesajı Gönder</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                    </button>
                </form>
            </div>
            
            <!-- Contact Info -->
            <div class="space-y-6">
                <!-- Address -->
                <div class="bg-white rounded-xl p-8 shadow-sm border border-eva-silver/30">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-eva-gold/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-eva-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-heading font-semibold text-lg text-eva-heading mb-2">Adres</h3>
                            <p class="text-eva-text">
                                Nişantaşı Mahallesi<br>
                                Valikonağı Caddesi No: 123<br>
                                Şişli / İstanbul
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Phone -->
                <div class="bg-white rounded-xl p-8 shadow-sm border border-eva-silver/30">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-eva-gold/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-eva-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-heading font-semibold text-lg text-eva-heading mb-2">Telefon</h3>
                            <p class="text-eva-text tabular-nums">
                                <a href="tel:+908501234567" class="hover:text-eva-gold transition-colors">
                                    0850 123 45 67
                                </a>
                            </p>
                            <p class="text-sm text-eva-muted mt-1">Pazartesi - Cumartesi: 09:00 - 18:00</p>
                        </div>
                    </div>
                </div>
                
                <!-- Email -->
                <div class="bg-white rounded-xl p-8 shadow-sm border border-eva-silver/30">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-eva-gold/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-eva-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-heading font-semibold text-lg text-eva-heading mb-2">E-posta</h3>
                            <p class="text-eva-text">
                                <a href="mailto:info@evahome.com" class="hover:text-eva-gold transition-colors">
                                    info@evahome.com
                                </a>
                            </p>
                            <p class="text-eva-text mt-1">
                                <a href="mailto:destek@evahome.com" class="hover:text-eva-gold transition-colors">
                                    destek@evahome.com
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media -->
                <div class="bg-white rounded-xl p-8 shadow-sm border border-eva-silver/30">
                    <h3 class="font-heading font-semibold text-lg text-eva-heading mb-4">Sosyal Medya</h3>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-eva-gold/20 flex items-center justify-center hover:bg-eva-gold hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-eva-gold/20 flex items-center justify-center hover:bg-eva-gold hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-eva-gold/20 flex items-center justify-center hover:bg-eva-gold hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-eva-charcoal mb-2">Adınız *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="w-full px-4 py-3 border-2 border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold focus:border-eva-gold transition-all">
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-eva-charcoal mb-2">E-posta *</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                   class="w-full px-4 py-3 border-2 border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold focus:border-eva-gold transition-all">
                        </div>
                    </div>
                    
                    <!-- Subject -->
                    <div>
                        <label class="block text-sm font-medium text-eva-charcoal mb-2">Konu *</label>
                        <input type="text" name="subject" value="{{ old('subject') }}" required
                               class="w-full px-4 py-3 border-2 border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold focus:border-eva-gold transition-all">
                    </div>
                    
                    <!-- Message -->
                    <div>
                        <label class="block text-sm font-medium text-eva-charcoal mb-2">Mesajınız *</label>
                        <textarea name="message" rows="6" required
                                  class="w-full px-4 py-3 border-2 border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold focus:border-eva-gold transition-all">{{ old('message') }}</textarea>
                    </div>
                    
                    <button type="submit" 
                            class="w-full btn-text bg-eva-gold hover:bg-eva-charcoal text-white px-8 py-4 rounded-lg transition-all duration-300 shadow-lg flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        <span>Gönder</span>
                    </button>
                </form>
            </div>
            
            <!-- Contact Info Cards -->
            <div class="space-y-6">
                <!-- Info Header -->
                <div class="text-center mb-8">
                    <x-wax-seal type="gold" size="lg" class="mx-auto mb-4" />
                    <x-heading level="3" class="mb-2">
                        Bize Ulaşın
                    </x-heading>
                    <p class="text-eva-text">Size yardımcı olmaktan mutluluk duyarız</p>
                </div>
                
                <!-- Phone -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-eva-silver/30 hover:border-eva-gold/50 transition-all">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-eva-gold/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-eva-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-eva-muted mb-1">Telefon</p>
                            <a href="tel:+908501234567" class="text-lg font-medium text-eva-charcoal hover:text-eva-gold transition-colors tabular-nums">
                                0850 123 45 67
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Email -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-eva-silver/30 hover:border-eva-gold/50 transition-all">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-eva-gold/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-eva-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-eva-muted mb-1">E-posta</p>
                            <a href="mailto:info@evahome.com" class="text-lg font-medium text-eva-charcoal hover:text-eva-gold transition-colors">
                                info@evahome.com
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Address -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-eva-silver/30 hover:border-eva-gold/50 transition-all">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-eva-gold/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-eva-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-eva-muted mb-1">Adres</p>
                            <p class="text-eva-charcoal">
                                Nişantaşı Mahallesi<br>
                                Valikonağı Caddesi No: 123<br>
                                Şişli / İstanbul
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

