/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js,php}", "./node_modules/flowbite/**/*.js"],
  theme: {
    extend: {
      colors: {
        primary: { "50": "#fffbeb", "100": "#fef3c7", "200": "#fde68a", "300": "#fcd34d", "400": "#fbbf24", "500": "#f59e0b", "600": "#d97706", "700": "#b45309", "800": "#92400e", "900": "#78350f", "950": "#451a03" }
      },
      dropShadow: {
        'logo': '0.25em 0.25em 3em #f59e0b66'
      }
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
  darkMode: 'class'
}