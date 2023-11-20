export default {
  trailingComma: 'es5',
  semi: false,
  singleQuote: true,
  printWidth: 180,
  plugins: ['@shufo/prettier-plugin-blade', 'prettier-plugin-tailwindcss'],
  overrides: [
    {
      files: ['*.blade.php'],
      options: {
        parser: 'blade',
        printWidth: 180,
        wrapAttributes: 'preserve',
        sortTailwindcssClasses: true,
        indentInnerHtml: false,
      },
    },
  ],
};
