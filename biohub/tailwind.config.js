import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                heading: ['"Space Grotesk"', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                background: {
                    DEFAULT: '#f3f6ff',
                    dark: '#080808',
                },

                text: {
                    DEFAULT: "#1e293b",
                    dark: "#f8fafc",
                },

                primary: "#3b82f6",

                brand: {
                    50: '#f0f4ff',
                    100: '#d9e2ff',
                    500: '#3b82f6',
                    600: '#2563eb',
                },

                surface: '#f8fafc',
            },

            boxShadow: {
                soft: '0 2px 15px -3px rgba(0,0,0,0.07), 0 4px 6px -2px rgba(0,0,0,0.05)',
            },
        },
    },

    plugins: [forms],
};