/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',
    content: [],
    safelist: [
        ...require('./resources/tailwind-save-lists/accessibility'),
        ...require('./resources/tailwind-save-lists/borders'),
        ...require('./resources/tailwind-save-lists/flexbox-and-grid'),
        ...require('./resources/tailwind-save-lists/interactivity'),
        ...require('./resources/tailwind-save-lists/sizing'),
        ...require('./resources/tailwind-save-lists/spacing'),
        ...require('./resources/tailwind-save-lists/svg'),
        ...require('./resources/tailwind-save-lists/transforms'),
        ...require('./resources/tailwind-save-lists/typography'),
    ],
    theme: {
        extend: {},
    },
    plugins: [],
}

