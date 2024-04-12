import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import preset from './vendor/foxws/wireui/resources/css/presets/tailwind.config.preset';
import theme from './resources/support/tailwind.config.preset';

/** @type {import('tailwindcss').Config} */
export default {
  presets: [preset, theme],
  content: ['./resources/**/*.blade.php', './src/App/**/*.blade.php', './vendor/filament/**/*.blade.php', './vendor/foxws/wireui/**/*.blade.php'],
  plugins: [forms, typography],
};
