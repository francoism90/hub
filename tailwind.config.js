import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";
import theme from "./resources/support/tailwind.config.preset";

/** @type {import('tailwindcss').Config} */
export default {
  presets: [theme],
  relative: true,
  content: [
    "./resources/**/*.{blade.php,js}",
    "./src/**/*.{blade.php,js}",
    "./vendor/foxws/wireuse/src/**/*.{php,js}",
  ],
  plugins: [forms, typography],
};
