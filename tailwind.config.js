import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";
import preset from "./vendor/foxws/wireuse/resources/css/presets/tailwind.config.preset";
import theme from "./resources/support/tailwind.config.preset";

/** @type {import('tailwindcss').Config} */
export default {
  presets: [preset, theme],
  content: [
    "./resources/**/*.blade.php",
    "./src/**/*.php",
    "./vendor/foxws/wireuse/**/*.php",
    "./vendor/foxws/wireuse/**/*.blade.php",
  ],
  plugins: [forms, typography],
};
