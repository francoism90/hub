import ui from '@nuxt/ui/vite'
import tailwindcss from '@tailwindcss/vite'
import vue from '@vitejs/plugin-vue'
import vueJsx from '@vitejs/plugin-vue-jsx'
import laravel from 'laravel-vite-plugin'
import { fileURLToPath, URL } from 'node:url'
import { defineConfig } from 'vite'
import vueDevTools from 'vite-plugin-vue-devtools'

// https://vite.dev/config/
export default defineConfig({
  server: {
    host: '0.0.0.0',
    port: 5173,
    strictPort: true,
    hmr: { host: 'localhost' },
    https: {},
    watch: {
      ignored: ['**/storage/**'],
    },
  },
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./resources/js', import.meta.url)),
      '~': fileURLToPath(new URL('./node_modules', import.meta.url)),
      '!': fileURLToPath(new URL('./vendor', import.meta.url)),
    },
  },
  plugins: [
    laravel({
      input: ['resources/js/app.ts'],
      ssr: 'resources/js/ssr.ts',
      refresh: true,
    }),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
      },
    }),
    vueJsx(),
    vueDevTools(),
    tailwindcss(),
    ui({
      ui: {
        colors: {
          primary: 'slate',
          neutral: 'gray',
        },
        input: {
          slots: {
            root: 'w-full',
          },
        },
      },
    }),
  ],
  build: {
    chunkSizeWarningLimit: 1024,
    rollupOptions: {
      output: {
        manualChunks: {
          http: ['axios'],
          ws: ['pusher-js', 'laravel-echo'],
        },
      },
    },
  },
})
