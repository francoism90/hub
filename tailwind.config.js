import preset from './vendor/foxws/livewire-use/resources/css/presets/tailwind.config.preset';
import theme from './resources/support/tailwind.config.preset';

/** @type {import('tailwindcss').Config} */
export default {
  presets: [preset, theme],
  content: [
    './resources/**/*.blade.php',
    './src/App/**/*.blade.php',
    './vendor/filament/**/*.blade.php',
    './vendor/foxws/livewire-use/**/*.blade.php',
  ],
};
