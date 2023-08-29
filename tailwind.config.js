/** @type {import('tailwindcss').Config} */

const colors = require('tailwindcss/colors')

export default {
  content: [
    './resources/**/*.blade.php',
    './vendor/filament/**/*.blade.php',
    './src/App/**/*.blade.php'
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: [
          'Inter, ui-sans-serif, system-ui',
          {
            fontFeatureSettings: '"calt", "case", "ccmp", "cv11", "ss01"',
            fontVariationSettings: '"opsz" 32',
          },
        ],
        serif: ['Montserrat, ui-serif'],
      },
      colors: {
        primary: colors.pink,
        gray: colors.gray,
      },
    },
  },
  plugins: [require('@tailwindcss/typography')],
}
