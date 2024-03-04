export default {
  trailingComma: 'es5',
  semi: true,
  singleQuote: true,
  printWidth: 180,
  plugins: ['@prettier/plugin-php', 'prettier-plugin-tailwindcss'],
  overrides: [
    {
      files: ['*.php', '*.blade.php'],
      options: {
        parser: 'php',
        printWidth: 180,
        singleQuote: true,
      },
    },
  ],
};
