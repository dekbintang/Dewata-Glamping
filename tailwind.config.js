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
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                glamp: {
                    50: '#f8fafc',
                    100: '#d8f3dc',
                    400: '#74c69d', // accent
                    600: '#40916c', // secondary
                    800: '#2d6a4f', // primary
                    900: '#1b4332', // sidebar bg
                }
            }
        },
    },

    plugins: [forms],
};

