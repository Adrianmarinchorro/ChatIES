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
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            width: {
                '128': '90rem',
            },
            height: {
                '128': '91vh',
                '100' : '80vh',
            },
            scrollbar: {
                width: '0px',
                height: '0px',
                // Añadir aquí más opciones de personalización si se desean
              },
        },
    },

    daisyui: {
        themes: [
            {
                mytheme: {

                    "primary": "#1d4ed8",

                    "secondary": "#166534",

                    "accent": "#37CDBE",

                    "neutral": "#3D4451",

                    "base-100": "#FFFFFF",

                    "info": "#3ABFF8",

                    "success": "#36D399",

                    "warning": "#FBBD23",

                    "error": "#F87272",
                },
            },
        ],
    },

    plugins: [require('@tailwindcss/forms'), require("daisyui"), require('tailwind-scrollbar')],

};
