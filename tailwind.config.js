const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            gridTemplateColumns: {
                'auto': 'repeat(auto-fill, 10rem)',
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            aspectRatio: {
                '4/3': '4 / 3',
                '3/4': '3 / 4',
            },
            scale: {
                'mirror': '-1'
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
