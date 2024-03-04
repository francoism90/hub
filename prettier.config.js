export default {
  trailingComma: 'es5',
  semi: true,
  singleQuote: true,
  printWidth: 180,
  plugins: ['@prettier/plugin-php', 'prettier-plugin-tailwindcss'],
  overrides: [
    {
      files: ['*.blade.php'],
      options: {
        parser: 'php',
        phpVersion: '8.1',
        printWidth: 180,
        singleQuote: true,
      },
    },
  ],
};
