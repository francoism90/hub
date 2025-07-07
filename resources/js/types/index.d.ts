import type { FormDataConvertible } from '@inertiajs/core'

export type FormDataType = Record<string, FormDataConvertible>

export type User = {
  id: string
  name: string
  email: string
  email_verified: string
  avatar?: string
  roles?: string[]
  permissions?: string[]
  created: string
  updated: string
}

export type Tag = {
  id: string
  name: string
  description: string
  type: string
  videos: number
  created: string
  updated: string
}

export type Post = {
  id: string
  user: User
  name: string
  summary: string
  content: string
  duration: number
  manifest: string
  preview: string
  timestamp: string
  thumbnail: string
  srcset: string
  favorited: boolean
  saved: boolean
  published: string
  created: string
  updated: string
  tags: Tag[]
}

export type Links = {
  first: string | null
  last: string | null
  prev: string | null
  next: string | null
}

export type Meta = {
  current_page: number | null
  from: number | null
  per_page: number | null
  to: number | null
}

export type Items = {
  data: Post[]
  links: Links
  meta: Meta
  current_page?: number | null
  current_page_url?: string | null
  first_page_url?: string | null
  last_page_url?: string | null
  next_page_url?: string | null
  prev_page_url?: string | null
}
