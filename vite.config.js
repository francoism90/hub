import { defineConfig } from 'vite';
import { readFileSync } from 'fs';
import { fileURLToPath, URL } from 'url';
import { VitePWA } from 'vite-plugin-pwa';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig(({ mode }) => {
  let https = false;

  if (mode === 'development') {
    https = {
      cert: readFileSync('/etc/certs/cert.pem'),
      key: readFileSync('/etc/certs/key.pem'),
    };
  }

  return {
    server: {
      host: 'hub.lan',
      https,
      port: 5173,
      strictPort: true,
      hmr: { host: 'hub.lan' },
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
        input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/filament/admin/theme.css'],
        refresh: [...refreshPaths, 'resources/**', 'src/**'],
      }),
      VitePWA({
        registerType: 'autoUpdate',
        injectRegister: 'script-defer',
        outDir: 'public/build',
        base: 'public',
        buildBase: '/build/',
        scope: '/',
        workbox: {
          cleanupOutdatedCaches: true,
          directoryIndex: null,
          globPatterns: ['**/*.{js,css,html,svg,jpg,png,ico,txt,woff,woff2}'],
          maximumFileSizeToCacheInBytes: 4194304,
          navigateFallback: null,
          navigateFallbackDenylist: [/\/[api,admin,livewire,vod]+\/.*/],
        },
        manifest: {
          name: 'Hub',
          short_name: 'Hub',
          description: 'Hub',
          theme_color: '#030712',
          background_color: '#030712',
          orientation: 'portrait-primary',
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
        output: {
          manualChunks: {
            utils: ['axios'],
            ws: ['laravel-echo', 'pusher-js'],
            player: ['shaka-player', 'shaka-player/dist/shaka-player.ui'],
          },
        },
      },
    },
  };
});
