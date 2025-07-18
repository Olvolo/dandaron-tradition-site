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
            // ===== НОВАЯ ПЛОСКАЯ И ПРОСТАЯ ПАЛИТРА =====
            // colors: {
            //     // Акцентный/основной цвет
            //     'primary': '#d9d514',       // Золотой
            //     'primary-hover': '#adab2a', // Золотой темнее
            //
            //     // Цвета для фона страниц
            //     'site-bg': '#01617d',       // Глубокий синий
            //     'site-bg-light': '#02c0f7',  // Очень светлый для светлой темы
            //
            //     // Цвета для поверхностей (карточки, шапка, подвал)
            //     'surface': '#2cb6de',      // Синий чуть светлее
            //     'surface-light': '#d4f5ff',// светло-голубой
            //     'surface-dark': '#167e9e',
            //
            //     // Цвета для текста
            //     'body-text': '#fffacc',         // Кремовый (основной на тёмном фоне)
            //     'body-text-muted': '#d6d3b2',  // Приглушенный светло-серо-кремовый
            //     'body-text-dark': '#092830',    // Глубокий синий (основной на светлом фоне)
            //     'body-text-dark-muted': '#0791b5', // Приглушенный сине-серый
            //
            //     'border': {
            //         'light': '#42d5ff', // светло-небесный
            //         'dark': '#05576e',  // тёмно-небесный
            //     }
            // }
            // ===== ФИНАЛЬНАЯ ПРОСТАЯ ПАЛИТРА =====
            colors: {
                // Наследуем стандартные цвета, чтобы не терять gray, white, black и т.д.
                ...defaultTheme.colors,

                // Наши кастомные цвета
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
            }
        },
    },

    plugins: [forms],
};
