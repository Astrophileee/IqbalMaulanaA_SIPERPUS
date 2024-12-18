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
            transform: {
                'flip-horizontal': 'scaleX(-1)',
                'flip-vertical': 'scaleY(-1)',
            },
        },
    },

    plugins: [forms,
        function ({ addUtilities }) {
            addUtilities({
                '.flip-horizontal': {
                    transform: 'scaleX(-1)',
                },
                '.flip-vertical': {
                    transform: 'scaleY(-1)',
                },
            });
        },
    ],
};
