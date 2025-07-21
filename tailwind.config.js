/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './app/Views/**/*.twig',   // ⬅️ szuka wszystkich twigów
    './app/**/*.php',
    './resources/**/*.js',
    './resources/**/*.css'
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
