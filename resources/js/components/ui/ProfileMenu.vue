<script lang="ts" setup>
import type { DropdownMenuItem } from '@nuxt/ui'

const items: DropdownMenuItem[] = [
  {
    label: 'Logout',
    icon: 'i-lucide-log-out',
    // async onSelect(_e: Event) {
    //   await logout()
    // },
  },
]
</script>

<template>
  <UDropdownMenu :items>
    <UButton
      color="neutral"
      size="md"
      icon="i-lucide-circle-user"
      variant="ghost"
    />
  </UDropdownMenu>
</template>
