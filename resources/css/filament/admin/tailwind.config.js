import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
  presets: [preset],
  content: [
    './src/Filament/**/*.php',
    './resources/**/*.blade.php',
    './vendor/filament/**/*.blade.php'
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
    },
  },
}
