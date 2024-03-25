export default {
  trailingComma: 'es5',
  semi: true,
  singleQuote: true,
  printWidth: 180,
  plugins: ['prettier-plugin-tailwindcss'],
  overrides: [
    {
      files: ['*.blade.php'],
      options: {
        parser: 'html',
      },
    },
  ],
};
