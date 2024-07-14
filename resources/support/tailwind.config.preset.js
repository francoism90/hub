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
        primary: colors.pink,
        secondary: colors.gray,
        info: colors.blue,
        success: colors.gray,
        error: colors.red,
        warning: colors.yellow,
      },
      container: {
        center: true,
        padding: '1rem',
      },
    },
  },
};
