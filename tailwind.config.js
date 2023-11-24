/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/views/**/**.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "node_modules/preline/dist/*.js",
    ],
    theme: {
        extend: {
            colors: {
                gris: "#3f4447",
                verde: "#00b588",
            },
        },
    },
    plugins: [require("preline/plugin")],
};
