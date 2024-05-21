/* eslint-disable no-unused-expressions */
import { registerSW } from 'virtual:pwa-register';
import '@/public/storage/images/android-chrome-192x192.png';
import '@/public/storage/images/android-chrome-512x512.png';

const intervalMS = 60 * 60 * 1000;

registerSW({
  immediate: true,
  onRegisteredSW(swUrl, r) {
    r &&
      setInterval(async () => {
        if (!(!r.installing && navigator)) return;

        if ('connection' in navigator && !navigator.onLine) return;

        const resp = await fetch(swUrl, {
          cache: 'no-store',
          headers: {
            cache: 'no-store',
            'cache-control': 'no-cache',
          },
        });

        if (resp?.status === 200) await r.update();
      }, intervalMS);
  },
});
