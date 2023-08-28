import { defineConfig } from 'vite'
import { readFileSync } from 'fs'
import { fileURLToPath, URL } from 'url'
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
      input: [
        'src/App/Web/Resources/Assets/css/app.css',
        'src/App/Web/Resources/Assets/js/app.js',
      ],
      refresh: [...refreshPaths, 'src/App/**', 'src/Admin/**'],
    }),
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
