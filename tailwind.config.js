import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    // Content sources for purging unused CSS
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './resources/js/**/*.vue',
        './app/View/**/*.php',
    ],

    // Safelist - classes that should never be purged
    safelist: [
        // Dynamic classes that might be missed by purge
        {
            pattern: /^(bg|text|border)-(red|green|blue|yellow|purple|pink|indigo)-(100|200|300|400|500|600|700|800|900)$/,
            variants: ['hover', 'focus', 'active'],
        },
        // Preserve common utility classes
        'container',
        'mx-auto',
        'px-4',
        'py-2',
        'font-bold',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],

    // Important: Enable JIT mode for faster builds and smaller CSS
    mode: 'jit',
};
