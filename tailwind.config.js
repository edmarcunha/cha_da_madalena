import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                // sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                poppins: ['Poppins', 'sans-serif'],
            },
            colors: {
                'wedding-olive': '#A7B5A1',
                'wedding-gold': '#E8D5A3',
                'wedding-white': '#F9FAFB',
                'wedding-dark': '#1F2937',
                'wedding-gray': '#E5E7EB',
            },
        },
    },

    plugins: [forms],
};
