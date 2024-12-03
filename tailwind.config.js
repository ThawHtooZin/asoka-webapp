import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            backgroundColor:{
                primary: '#0018A8',
                asokablue: '#0018A8',
            },
            borderColor:{
                primary: '#0018A8',
                warning: '#FF9800',
            },
            textColor:{
                primary: '#0018A8',
                t1: '#0018A8',
                t2: '#FEDF00',
                t3: '#ED1B24',
                t4: '#FFFFFF',
                t5: '#FF9800',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            letterSpacing: {
                'xxl': '0.4em',
              },
            boxShadowColor: {
                t5: '#FF9800',
            }
        },

    },
    plugins: [],
};
