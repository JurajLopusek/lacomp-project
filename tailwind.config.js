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
                'custom': '0 40px 8px rgba(0, 0, 0.1, 0.2)', // Definovanie vlastného tieňa
            },
            backgroundColor: {
                'red-hover': '#f56565', // Definovanie vlastného pozadia
            },
            cursor: {
                'pointer': 'pointer', // Definovanie vlastného kurzora
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
