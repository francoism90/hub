/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './src/App/**/*.php',
    './src/App/**/*.blade.php',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: [
          'Inter, ui-sans-serif, system-ui',
          {
            fontFeatureSettings: '"calt", "case", "ccmp", "cv11", "ss01"',
            fontVariationSettings: '"opsz" 32'
          }
        ],
        serif: ['Montserrat, ui-serif']
      }
    }
  },
  plugins: [
    require('@tailwindcss/typography'),
  ],
}

