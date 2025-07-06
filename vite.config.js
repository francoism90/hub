import laravel, { refreshPaths } from 'laravel-vite-plugin'
import { fileURLToPath, URL } from 'node:url'
import { defineConfig } from 'vite'
import { VitePWA } from 'vite-plugin-pwa'

// https://vite.dev/config/
export default defineConfig({
  server: {
    host: '0.0.0.0',
    port: 5173,
    strictPort: true,
    hmr: { host: 'vite.aqua.test', clientPort: 443, protocol: 'wss' },
  },
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./', import.meta.url)),
      '~': fileURLToPath(new URL('./node_modules', import.meta.url)),
      '!': fileURLToPath(new URL('./vendor', import.meta.url)),
    },
  },
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: [...refreshPaths, 'resources/**', 'src/**'],
    }),
    VitePWA({
      scope: '/',
      buildBase: '/build/',
      registerType: 'autoUpdate',
      injectRegister: 'auto',
      workbox: {
        navigateFallback: null,
        navigateFallbackDenylist: [/\/[livewire,api,live,vod]+\/.*/],
      },
      manifest: {
        name: 'Hub',
        short_name: 'Hub',
        description: 'A video on demand (VOD) media distribution system.',
        categories: ['videos', 'streaming', 'vod'],
        theme_color: '#030712',
        background_color: '#030712',
        display_override: ['standalone', 'minimal-ui'],
        display: 'standalone',
        orientation: 'natural',
        id: '/',
        scope: '/',
        start_url: '/',
        icons: [
          {
            src: '/storage/images/android-chrome-192x192.png',
            sizes: '192x192',
            type: 'image/png',
          },
          {
            src: '/storage/images/android-chrome-512x512.png',
            sizes: '512x512',
            type: 'image/png',
            purpose: 'any maskable',
          },
        ],
      },
    }),
  ],
  build: {
    chunkSizeWarningLimit: 1024,
    rollupOptions: {
      external: ['workbox-window'],
      output: {
        manualChunks: {
          http: ['axios'],
          ws: ['pusher-js', 'laravel-echo'],
          play: ['shaka-player', 'shaka-player/dist/shaka-player.ui'],
          pwa: ['virtual:pwa-register'],
        },
      },
    },
  },
})
