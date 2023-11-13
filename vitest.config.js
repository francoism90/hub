import { defineConfig } from 'vite'


export default defineConfig({
  server: {
    host: 'localhost',
    port: 5173,
    strictPort: true,
    hmr: undefined,
    https: false,
  },
})
