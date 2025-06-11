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
  name: string
  type: string
  videos: number
  created: string
  updated: string
}

export type Video = {
  id: string
  user: User
  name: string
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
