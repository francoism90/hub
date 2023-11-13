import { defineConfig } from 'vitest/config'
import { fileURLToPath, URL } from 'url'
import laravel, { refreshPaths } from 'laravel-vite-plugin'

export default defineConfig({
  define: {
    'import.meta.vitest': 'undefined',
  },
  test: {
    includeSource: ['src/**/*.{js,ts}']
  },
  server: {
    hmr: undefined,
    https: false
  },
  resolve: {
    alias: {
      '~': fileURLToPath(new URL('./node_modules', import.meta.url)),
      '!': fileURLToPath(new URL('./vendor', import.meta.url)),
    },
  },
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/css/filament/admin/theme.css',
      ],
      refresh: [...refreshPaths, 'resources/**', 'src/**'],
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
