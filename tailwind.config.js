import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            // EVA HOME Premium Typography System
            fontFamily: {
                // Body text, menus, buttons, prices
                'sans': ['Inter', ...defaultTheme.fontFamily.sans],
                'body': ['Inter', ...defaultTheme.fontFamily.sans],
                
                // Headings (H1-H3) - Elegant & Luxury
                'heading': ['Playfair Display', 'Georgia', 'serif'],
                'display': ['Playfair Display', 'Georgia', 'serif'],
            },
            
            fontWeight: {
                normal: '400',
                medium: '500',
                semibold: '600',
                bold: '700',
            },
            
            letterSpacing: {
                'tighter': '-0.02em',
                'tight': '-0.01em',
                'normal': '0',
                'wide': '0.01em',
                'wider': '0.02em',
                'widest': '0.2px',
            },
            
            colors: {
                // EVA HOME Premium Color Palette
                'eva': {
                    // Typography Colors
                    'heading': '#1B1B1B',
                    'body': '#222222',
                    'text': '#333333',
                    'price': '#000000',
                    'muted': '#666666',
                    'light': '#999999',
                    
                    // Brand Colors
                    'soft-white': '#FAF8F6',      // Arka plan (web beyazı)
                    'charcoal': '#2B2B2B',        // Metin (ana gövde)
                    'gold': '#D8B36F',            // Altın detay (mühür, ip, vurgular)
                    'silver': '#C7C2BA',          // Gümüş detay
                    
                    // Collection Colors
                    'jasmine': '#F6EBD9',         // Golden Jasmine
                    'rose': '#D9A7A0',            // Velvet Rose
                    'citrus': '#F9CBA3',          // Citrus Harmony
                    'bloom': '#F5CEDB',           // Luminous Bloom
                    'oud': '#C9D8C5',             // Sacred Oud
                    'earth': '#D7C8B6',           // Earth Harmony
                    'spice': '#C4BDB5',           // Royal Spice
                    'lavender': '#D4C3E1',        // Lavender Peace
                },
            },
        },
    },

    plugins: [
        forms,
        // EVA HOME Typography Utilities
        function({ addUtilities, addComponents }) {
            // Tabular nums for prices
            const newUtilities = {
                '.tabular-nums': {
                    'font-variant-numeric': 'tabular-nums',
                    'font-feature-settings': '"tnum" 1',
                },
                '.proportional-nums': {
                    'font-variant-numeric': 'proportional-nums',
                },
            }
            addUtilities(newUtilities, ['responsive'])
            
            // Premium Typography Components
            const components = {
                '.heading': {
                    'font-family': 'Playfair Display, Georgia, serif',
                    'font-weight': '600',
                    'color': '#1B1B1B',
                    'letter-spacing': '0.2px',
                    'line-height': '1.2',
                },
                '.nav-text': {
                    'font-family': 'Inter, system-ui, sans-serif',
                    'font-weight': '500',
                    'letter-spacing': '0.2px',
                    'color': '#222',
                },
                '.btn-text': {
                    'font-family': 'Inter, system-ui, sans-serif',
                    'font-weight': '500',
                    'letter-spacing': '0.2px',
                },
                '.price-text': {
                    'font-family': 'Inter, system-ui, sans-serif',
                    'font-weight': '500',
                    'letter-spacing': '0.1px',
                    'color': '#000',
                    'font-variant-numeric': 'tabular-nums',
                    'font-feature-settings': '"tnum" 1',
                },
                '.body-text': {
                    'font-family': 'Inter, system-ui, sans-serif',
                    'font-weight': '400',
                    'color': '#333',
                    'line-height': '1.6',
                },
            }
            addComponents(components)
        },
    ],
};
