export default {
  trailingComma: 'es5',
  semi: true,
  singleQuote: true,
  printWidth: 180,
  plugins: ['@shufo/prettier-plugin-blade', 'prettier-plugin-tailwindcss'],
  overrides: [
    {
      files: ['*.blade.php'],
      options: {
        parser: 'blade',
        printWidth: 180,
        wrapAttributes: 'force-expand-multiline',
        sortTailwindcssClasses: true,
        sortHtmlAttributes: 'vuejs',
        indentInnerHtml: false,
      },
    },
  ],
};
