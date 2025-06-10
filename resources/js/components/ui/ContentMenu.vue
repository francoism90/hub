<script lang="ts" setup>
import type { DropdownMenuItem } from '@nuxt/ui'

const items: DropdownMenuItem[] = [
  {
    label: 'New Provider',
    icon: 'i-lucide-plug',
    to: '/',
  },
]
</script>

<template>
  <UDropdownMenu :items>
    <UButton
      color="neutral"
      size="md"
      icon="i-lucide-file-plus"
      variant="ghost"
    />
  </UDropdownMenu>
</template>
