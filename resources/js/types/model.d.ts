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
  thumbnail: string
  srcset: string
  created_at: string
  updated_at: string
}
