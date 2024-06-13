/** @type {import('tailwindcss').Config} */

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            boxShadow: {
                'lc': '0 0 0.5rem #f56565', // Definovanie vlastného tieňa
            },
            cursor: {
                'pointer': 'pointer', // Definovanie vlastného kurzora
            },
            colors: {
                'lc-red': '#f56565',
                'midnight': '#121063',
            },
        },
    },
    variants: {
        extend: {
            boxShadow: ['hover'], // Povolenie tieňa pri prechode kurzorom
            backgroundColor: ['hover'], // Povolenie zmeny pozadia pri prechode kurzorom
        },
    },
    plugins: [],
}
