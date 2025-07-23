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
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primary': '#d9d514',       // Золотой
                'primary-hover': '#adab2a', // Золотой темнее
                'brand-blue': {
                    'light': '#d4f5ff', // светло-голубой
                    'DEFAULT': '#01617d', // глубокий синий (основной)
                    'dark': '#092830',  // очень тёмный синий (для текста)
                },
                'brand-cream': {
                    'light': '#fffacc', // кремовый
                    'DEFAULT': '#d6d3b2', // приглушенный кремовый
                }
            },
        },
    },

    plugins: [forms],
};
