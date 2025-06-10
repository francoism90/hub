import type { User } from '@/modules/users/types'
import type { Page } from '@inertiajs/core'

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
