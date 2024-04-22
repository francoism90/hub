import colors from 'tailwindcss/colors';

export default {
  theme: {
    extend: {
      fontFamily: {
        sans: [
          'Inter, ui-sans-serif, system-ui, sans-serif',
          {
            fontFeatureSettings: '"calt", "case", "ccmp", "cv11", "ss01"',
            fontVariationSettings: '"opsz" 32',
          },
        ],
        serif: ['Montserrat', 'ui-serif', 'serif'],
        mono: ['IBM Plex Mono', 'ui-monospace', 'monospace'],
      },
      colors: {
        primary: colors.pink,
        secondary: colors.gray,
      },
    },
  },
};
