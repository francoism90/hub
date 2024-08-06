import { defineConfig } from "vite";
import { readFileSync } from "fs";
import { fileURLToPath, URL } from "url";
import { VitePWA } from "vite-plugin-pwa";
import laravel, { refreshPaths } from "laravel-vite-plugin";

export default defineConfig(({ mode }) => {
  let https = false;

  if (mode === "development") {
    https = {
      cert: readFileSync("/run/secrets/cert.pem"),
      key: readFileSync("/run/secrets/key.pem"),
    };
  }

  return {
    server: {
      host: "0.0.0.0",
      https,
      port: 5173,
      strictPort: true,
      hmr: {
        host: "hub.lan",
        clientPort: 5173,
      },
      watch: {
        ignored: ["**/storage/**", "**/vendor/**"],
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
        outDir: "public/build",
        base: "public",
        buildBase: "/build/",
        scope: "/",
        registerType: "autoUpdate",
        injectRegister: "script-defer",
        workbox: {
          cleanupOutdatedCaches: true,
          directoryIndex: null,
          globPatterns: ["**/*.{js,css,html,svg,jpg,png,webp,ico,txt,woff,woff2}"],
          maximumFileSizeToCacheInBytes: 4194304,
          navigateFallback: null,
          navigateFallbackDenylist: [/\/[api,livewire,vod]+\/.*/],
        },
        manifest: {
          name: "Hub",
          short_name: "Hub",
          description: "Hub",
          categories: ["videos", "vod"],
          theme_color: "#030712",
          background_color: "#030712",
          display_override: ["fullscreen", "minimal-ui"],
          display: "fullscreen",
          orientation: "portrait-primary",
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
  };
});
