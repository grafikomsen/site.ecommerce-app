import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: 'class',
    theme: {
        screens: {
            sm: "480px",
            md: "768px",
            lg: "1024px"
        },
        extend: {
            colors: {
                primaryColor: '#d14900',
                primaryColorLight: "#c0c0c0",
                secondaryColor: '#007185',
                paragraphColor: '#c0c0c0',
                whiteColor: '#fff',
                blackColor: "#000",
                grayColor: "#37475A",
                grayLightColor: "#333",
                greenColor: "#007936",
                redColor: "#cc3433",
                darkColor: '#000',
                darkColorLight: "#171717",
            },
            keyframes: {
                move: {
                "50%": {transform: 'translateY(-1rem)'}
                }
            },
            animation: {
                'movingY': 'move 2s linear infinite'
            }
        },
        container: {
            center: true,
            padding: {
                DEFAULT: '1.8rem',
                sm: '1.5rem'
            }
        },
        fontFamily: {
            sans: ['Poppins', ...defaultTheme.fontFamily.sans],
        },
    },

    plugins: [forms],
};
