import '@fontsource/material-icons-round';
import shaka from 'shaka-player/dist/shaka-player.ui';

shaka.polyfill.installAll();

window.shaka = shaka;
