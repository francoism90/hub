import { defineConfig } from 'vite'
import { readFileSync } from 'fs'
import { fileURLToPath, URL } from 'url'
import { VitePWA } from 'vite-plugin-pwa'
import laravel, { refreshPaths } from 'laravel-vite-plugin'

const host = 'hub.test'

export default defineConfig({
  server: {
    host,
    port: 5173,
    strictPort: true,
    hmr: { host },
    https: {
      cert: readFileSync('/run/secrets/cert.pem'),
      key: readFileSync('/run/secrets/key.pem'),
    },
  },
  resolve: {
    alias: {
      '~': fileURLToPath(new URL('./vendor', import.meta.url)),
      '@': fileURLToPath(new URL('./node_modules', import.meta.url)),
    },
  },
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/filament/admin/theme.css'],
      refresh: [...refreshPaths, 'src/App/**', 'src/Admin/**'],
    }),
    VitePWA({
      strategies: 'injectManifest',
      srcDir: 'resources/service-worker',
      outDir: 'public/build',
    })
  ],
  build: {
    chunkSizeWarningLimit: 1024,
    rollupOptions: {
      output: {
        manualChunks: {
          player: ['shaka-player', 'shaka-player/dist/shaka-player.ui'],
          utils: ['axios'],
          ws: ['laravel-echo', 'pusher-js'],
        },
      },
    },
  },
})
