export type User = {
  id: string
  name: string
  email: string
  email_verified: string
  created: string
  updated: string
}

export type Tag = {
  id: string
  name: Record<string, string>
  type: string
  videos: number
  created: string
  updated: string
}

export type Video = {
  id: string
  user: User
  name: Record<string, string>
  summary: string
  content: string
  thumbnail: string
  duration: number
  timestamp: string
  thumbnail: string
  srcset: string
  created: string
  created_human: string
  updated: string
  updated_human: string
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
  data: Video[]
  links: Links
  meta: Meta
}
