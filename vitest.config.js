import { defineConfig } from 'vitest/config'

export default defineConfig({
  define: {
    'import.meta.vitest': 'undefined',
  },
  server: {
    hmr: undefined,
    https: false
  }
})
