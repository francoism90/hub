import { createInertiaApp } from '@inertiajs/vue3'
import createServer from '@inertiajs/vue3/server'
import { renderToString } from '@vue/server-renderer'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { createSSRApp, DefineComponent, h } from 'vue'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

createServer(
  (page) =>
    createInertiaApp({
      page,
      render: renderToString,
      title: (title) => `${title} - ${appName}`,
      resolve: resolvePage,
      setup: ({ App, props, plugin }) =>
        createSSRApp({ render: () => h(App, props) }).use(plugin),
    }),
  { cluster: true },
)

function resolvePage(name: string) {
  const pages = import.meta.glob<DefineComponent>('./pages/**/*.vue')

  return resolvePageComponent<DefineComponent>(`./pages/${name}.vue`, pages)
}
