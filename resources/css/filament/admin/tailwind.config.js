import preset from '../../../../vendor/filament/filament/tailwind.config.preset';
import theme from '../../../support/tailwind.config.preset';

export default {
  presets: [preset, theme],
  content: ['./src/Filament/**/*.php', './resources/**/*.blade.php', './vendor/filament/**/*.blade.php'],
};
