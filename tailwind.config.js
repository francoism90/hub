import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import theme from './resources/support/tailwind.config.preset';

/** @type {import('tailwindcss').Config} */
export default {
  presets: [theme],
  content: ['./resources/**/*.blade.php', './vendor/filament/**/*.blade.php', './src/App/**/*.blade.php'],
  plugins: [forms, typography],
};
