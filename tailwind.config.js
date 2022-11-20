const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],

    options: {
        safelist: {
            standard: [
                'text-2xl',
                'text-3xl',
                'text-4xl',
                'text-5xl',
                'text-6xl',
                'sm:text-2xl',
                'sm:text-3xl',
                'sm:text-4xl',
                'sm:text-5xl',
                'sm:text-6xl',
                'md:text-2xl',
                'md:text-3xl',
                'md:text-4xl',
                'md:text-5xl',
                'md:text-6xl',
                'lg:text-2xl',
                'lg:text-3xl',
                'lg:text-4xl',
                'lg:text-5xl',
                'lg:text-6xl',
                'lg:grid-cols-3',
                'h-10',
                'h-20',
                'h-48',
                'h-52',
                'h-56',
                'h-60',
                'h-64',
                'h-80',
            ],
        },
    }
};
