/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/views/**/**.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "node_modules/preline/dist/*.js",
    ],
    theme: {
        extend: {},
    },
    plugins: [require("preline/plugin")],
};
