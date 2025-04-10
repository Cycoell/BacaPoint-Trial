/** @type {import('tailwindcss').Config} */
export default {
    content: [ 
        "./*.php",                  
        "./pages/**/*.php",         
        "./library/**/*.{html,php}",
        "./src/**/*.{html,js,php}", 
        "./uploads/**/*.{php,html}"],
    theme: {
        extend: {},
    },
    plugins: [],
}