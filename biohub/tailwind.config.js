import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                heading: ['"Space Grotesk"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // The Clean Blue Palette
                background: {
                    DEFAULT: '#f3f6ff', // Light theme background
                    dark: '#080808',    // Dark theme background
                },
                text: {
                    DEFAULT: "#1e293b", // Deep slate for light mode
                    dark: "#f8fafc",    // Off-white for dark mode
                },  
                primary: "#3b82f6",
                brand: {
                    50: '#f0f4ff',
                    100: '#d9e2ff',
                    500: '#3b82f6', // The primary blue sidebar
                    600: '#2563eb',
                },
                surface: '#f8fafc', // Light grey background
            },
            boxShadow: {
                'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
            }
        },
    },
    plugins: [forms],
};