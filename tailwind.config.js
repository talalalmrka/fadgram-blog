import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        "./resources/**/*.css",
        "./resources/**/*.scss",
    ],
    safelist: [
        'min-h-50vh',
        'min-h-75vh',
        'animate-bounce',
        'dark:bg-gray-700',
        'bg-instagram',
        'bg-twitter',
        'bg-facebook',
        'bg-whatsapp',
        'bg-snapchat',
        'bg-telegram',
        'bg-pinterest',
        'bg-tiktok',
        'bg-linkedin',
        'bg-youtube',
        'text-gray-100',
        //'text-red',
        /*{
            pattern: /^(w|h|min-w|min-h|bg|text)-/,
        },*/
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#7c3aed',
                    50: '#f5f3ff',
                    100: '#ede9fe',
                    200: '#ddd6fe',
                    300: '#c4b5fd',
                    400: '#a78bfa',
                    500: '#8b5cf6',
                    600: '#7c3aed',
                    700: '#6d28d9',
                    800: '#5b21b6',
                    900: '#4c1d95',
                },
                primaryblue: {
                    DEFAULT: '#4e73df',
                    50: '#f2f6fc',
                    100: '#e6edfa',
                    200: '#c0d3f4',
                    300: '#9ab8ef',
                    400: '#6d94e8',
                    500: '#4e73df',
                    600: '#3d5bc7',
                    700: '#3046a5',
                    800: '#243383',
                    900: '#1a2466',
                },
                secondary: {
                    DEFAULT: '#6b7280',
                    50: '#f9fafb',
                    100: '#f3f4f6',
                    200: '#e5e7eb',
                    300: '#d1d5db',
                    400: '#9ca3af',
                    500: '#6b7280',
                    600: '#4b5563',
                    700: '#374151',
                    800: '#1f2937',
                    900: '#111827',
                    950: '#030712',
                },
                light: {
                    DEFAULT: '#f9f9f9',
                    50: '#ffffff',
                    100: '#fefefe',
                    200: '#fdfdfd',
                    300: '#fcfcfc',
                    400: '#fbfbfb',
                    500: '#f9f9f9',
                    600: '#f7f7f7',
                    700: '#f5f5f5',
                    800: '#f3f3f3',
                    900: '#f1f1f1',
                },
                dark: {
                    DEFAULT: '#292D38',
                    50: '#E3E4E8',
                    100: '#C6C7D1',
                    200: '#8F91A3',
                    300: '#575A74',
                    400: '#404356',
                    500: '#292D38',
                    600: '#252933',
                    700: '#1A1D25',
                    800: '#131418',
                    900: '#0D0E10',
                },
                blue: {
                    DEFAULT: '#2563eb',
                    50: '#eff6ff',
                    100: '#dbeafe',
                    200: '#bfdbfe',
                    300: '#93c5fd',
                    400: '#60a5fa',
                    500: '#3b82f6',
                    600: '#2563eb',
                    700: '#1d4ed8',
                    800: '#1e40af',
                    900: '#1e3a8a',
                },
                green: {
                    DEFAULT: '#16a34a',
                    50: '#f0fdf4',
                    100: '#dcfce7',
                    200: '#bbf7d0',
                    300: '#86efac',
                    400: '#4ade80',
                    500: '#22c55e',
                    600: '#16a34a',
                    700: '#15803d',
                    800: '#166534',
                    900: '#14532d',
                },
                red: {
                    DEFAULT: '#dc2626',
                    50: '#fef2f2',
                    100: '#fee2e2',
                    200: '#fecaca',
                    300: '#fca5a5',
                    400: '#f87171',
                    500: '#ef4444',
                    600: '#dc2626',
                    700: '#b91c1c',
                    800: '#991b1b',
                    900: '#7f1d1d',
                },
                orange: {
                    DEFAULT: '#ea580c',
                    50: '#fff7ed',
                    100: '#ffedd5',
                    200: '#fed7aa',
                    300: '#fdba74',
                    400: '#fb923c',
                    500: '#f97316',
                    600: '#ea580c',
                    700: '#c2410c',
                    800: '#9a3412',
                    900: '#7c2d12',
                },
                yellow: {
                    DEFAULT: '#ca8a04',
                    50: '#fefce8',
                    100: '#fef9c3',
                    200: '#fef08a',
                    300: '#fde047',
                    400: '#facc15',
                    500: '#eab308',
                    600: '#ca8a04',
                    700: '#a16207',
                    800: '#854d0e',
                    900: '#713f12',
                },
                purple: {
                    DEFAULT: '#9333ea',
                    50: '#faf5ff',
                    100: '#f3e8ff',
                    200: '#e9d5ff',
                    300: '#d8b4fe',
                    400: '#c084fc',
                    500: '#a855f7',
                    600: '#9333ea',
                    700: '#7e22ce',
                    800: '#6b21a8',
                    900: '#581c87',
                },
                violet: {
                    DEFAULT: '#7c3aed',
                    50: '#f5f3ff',
                    100: '#ede9fe',
                    200: '#ddd6fe',
                    300: '#c4b5fd',
                    400: '#a78bfa',
                    500: '#8b5cf6',
                    600: '#7c3aed',
                    700: '#6d28d9',
                    800: '#5b21b6',
                    900: '#4c1d95',
                },
                cyan: {
                    DEFAULT: '#0891b2',
                    50: '#ecfeff',
                    100: '#cffafe',
                    200: '#a5f3fc',
                    300: '#67e8f9',
                    400: '#22d3ee',
                    500: '#06b6d4',
                    600: '#0891b2',
                    700: '#0e7490',
                    800: '#155e75',
                    900: '#164e63',
                },
                instagram: '#E4405F',
                twitter: '#1DA1F2',
                facebook: '#1877F2',
                whatsapp: '#25D366',
                snapchat: '#FFFC00',
                telegram: '#24A1DE',
                pinterest: '#BD081C',
                tiktok: '#EE1D51',
                linkedin: '#0A66C2',
                youtube: '#CD201F',
            },
            minHeight: {
                '10vh': '10vh',
                '25vh': '25vh',
                '50vh': '50vh',
                '75vh': '75vh',
                '100vh': '100vh',
                '1/10': '10%',
                '2/10': '20%',
                'full': '100%',
            },
            borderWidth: {
                DEFAULT: '1px',
                '0': '0',
                '1': '1px',
                '2': '2px',
                '3': '3px',
                '4': '4px',
                '5': '5px',
                '6': '6px',
                '7': '7px',
                '8': '8px',
                '9': '9px',
                '10': '10px',
            },
            boxShadow: {
                DEFAULT: '0 0 1rem 0 rgba(33, 37, 41, .15)',
                'sm': '0 0.125rem 0.5rem 0 rgba(33, 37, 41, .15)',
                'xs': '0 0.0625rem 0.25rem 0 rgba(33, 37, 41, .2)',
            },
            container: {
                center: true,
                padding: '1rem',
            },
            listStyleType: {
                circle: 'circle',
                square: 'square',
                'upper-roman': 'upper-roman',
                'lower-alpha': 'lower-alpha',
            },
            fontSize: {
                'xxs': '.5rem',
                'md': '.955rem',
            },
            transitionDuration: {
                '800': '800ms',
                '900': '900ms',
                '1000': '1000ms',
                '2000': '2000ms',
            },
            zIndex: {
                '100': '100',
                '200': '200',
                '300': '300',
                '400': '400',
                '500': '500',
                '600': '600',
                '700': '700',
                '800': '800',
                '900': '900',
                '1000': '1000',
                '1050': '1050',
                '1055': '1055',
                'full': '999999'
            },
            width: {
                'content': 'fit-content'
            },
            borderRadius: {
                DEFAULT: '0.25rem',
                'none': '0',
                'sm': '0.125rem',
                'md': '0.375rem',
                'lg': '0.5rem',
                'xl': '0.75rem',
                '2xl': '1rem',
                '3xl': '1.5rem',
                'full': '9999px',
                'b-full': '9999px',
            },
        },
    },

    //plugins: [forms],
    plugins: [],
    darkMode: 'class',
};
