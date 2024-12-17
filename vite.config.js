import { fileURLToPath, URL } from "node:url";
import { defineConfig } from "vite";
import { VitePWA } from "vite-plugin-pwa";
import basicSsl from "@vitejs/plugin-basic-ssl";
import laravel, { refreshPaths } from "laravel-vite-plugin";

// https://vite.dev/config/
export default defineConfig({
  server: {
    host: "0.0.0.0",
    port: 5173,
    hmr: { host: "localhost" },
    https: {},
    watch: {
      ignored: ["**/storage/**"],
    },
  },
  resolve: {
    alias: {
      "@": fileURLToPath(new URL("./", import.meta.url)),
      "~": fileURLToPath(new URL("./node_modules", import.meta.url)),
      "!": fileURLToPath(new URL("./vendor", import.meta.url)),
    },
  },
  plugins: [
    laravel({
      input: ["resources/css/app.css", "resources/js/app.js"],
      refresh: [...refreshPaths, "resources/**", "src/**"],
    }),
    VitePWA({
      buildBase: "/build/",
      scope: "/",
      registerType: "autoUpdate",
      injectRegister: "script-defer",
      workbox: {
        cleanupOutdatedCaches: true,
        directoryIndex: null,
        globDirectory: "/app/public/build",
        globPatterns: ["**/*.{js,css,html,svg,jpg,png,webp,ico,txt,woff,woff2}"],
        maximumFileSizeToCacheInBytes: 4194304,
        navigateFallback: null,
        navigateFallbackDenylist: [/\/[api,livewire,live,vod]+\/.*/],
      },
      manifest: {
        name: "Hub",
        short_name: "Hub",
        description: "A video on demand (VOD) media distribution system.",
        categories: ["videos", "streaming", "vod"],
        theme_color: "#030712",
        background_color: "#030712",
        display_override: ["standalone", "minimal-ui"],
        display: "standalone",
        orientation: "natural",
        id: "/",
        scope: "/",
        start_url: "/",
        icons: [
          {
            src: "/storage/images/android-chrome-192x192.png",
            sizes: "192x192",
            type: "image/png",
          },
          {
            src: "/storage/images/android-chrome-512x512.png",
            sizes: "512x512",
            type: "image/png",
            purpose: "any maskable",
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
          utils: ["axios"],
          ws: ["pusher-js", "laravel-echo"],
          player: ["shaka-player"],
          pwa: ["virtual:pwa-register"],
        },
      },
    },
  },
});
