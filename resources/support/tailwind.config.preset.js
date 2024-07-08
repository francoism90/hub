import { fontFamily } from "tailwindcss/defaultTheme";
import colors from "tailwindcss/colors";

export default {
  theme: {
    extend: {
      fontFamily: {
        sans: ["Jost", fontFamily.sans],
        serif: ["Montserrat", fontFamily.serif],
        mono: ["IBM Plex Mono", fontFamily.mono],
      },
      colors: {
        base: colors.white,
        primary: colors.pink,
        secondary: colors.gray,
      },
      container: {
        center: true,
        padding: '1rem',
      },
    },
  },
};
