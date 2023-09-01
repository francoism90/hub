import { createHandlerBoundToURL, precacheAndRoute } from 'workbox-precaching'
import { NavigationRoute, registerRoute } from 'workbox-routing'

// self.__WB_MANIFEST is default injection point
precacheAndRoute(self.__WB_MANIFEST, {
  directoryIndex: null,
  cleanURLs: false,
})
