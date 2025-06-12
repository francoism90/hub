import type { Page } from '@inertiajs/core'
import type { User } from '@types/model'

declare module '@inertiajs/core' {
  interface PageProps {
    app: string
    locale: string
    location: string
    flash: {
      message: string
      class: string
      level: string
    }
    auth: {
      user: User | undefined
      login: {
        route: string
      }
      logout: {
        route: string
      }
    }
  }
}

declare module '@inertiajs/vue3' {
  export declare function usePage<T>(): Page<T>
}
