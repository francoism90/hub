export default {
  trailingComma: 'es5',
  semi: false,
  singleQuote: true,
  plugins: ['@shufo/prettier-plugin-blade', 'prettier-plugin-tailwindcss'],
  overrides: [
    {
      files: ['*.blade.php'],
      options: {
        parser: 'blade',
        wrapAttributes: 'preserve',
        sortTailwindcssClasses: true,
        indentInnerHtml: false,
      },
    },
  ],
}
