export type User = {
  id: string
  name: string
  email: string
  email_verified_at: string
  created_at: string
  updated_at: string
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
}
