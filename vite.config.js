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
      registerSW: true,
      registerType: 'autoUpdate',
      injectRegister: 'script',
      srcDir: 'resources',
      outDir: 'public',
      base: '/',
      scope: '/',
      includeAssets: ['favicon.ico', 'apple-touch-icon.png', 'masked-icon.svg'],
      workbox: {
        navigateFallback: '/',
        maximumFileSizeToCacheInBytes: 4194304,
        navigateFallbackDenylist: [/\/[api,vod]+\/.*/],
        globPatterns: ['**/*.{css,js,html,svg,png,ico,txt,woff2}']
      },
      manifest: {
        name: 'Hub',
        short_name: 'Hub',
        description: 'Hub',
        theme_color: '#39336c',
        background_color: '#39336c',
        orientation: 'portrait-primary',
        id: '/',
        scope: '/',
        start_url: '/',
        // icons: [
        //   {
        //     src: 'images/android-chrome-192x192.png',
        //     sizes: '192x192',
        //     type: 'image/png'
        //   },
        //   {
        //     src: 'images/android-chrome-512x512.png',
        //     sizes: '512x512',
        //     type: 'image/png',
        //     purpose: 'any maskable'
        //   }
        // ]
      }
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
