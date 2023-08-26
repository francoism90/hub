export default {
  trailingComma: "es5",
  semi: false,
  singleQuote: true,
  plugins: [
    'prettier-plugin-tailwindcss',
  ],
  overrides: [
    {
      files: ["*.blade.php"],
    }
  ]
}
