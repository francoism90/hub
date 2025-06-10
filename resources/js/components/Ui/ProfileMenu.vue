<script lang="ts" setup>
import type { DropdownMenuItem } from '@nuxt/ui'
import { ref } from 'vue'

const items = ref<DropdownMenuItem[]>([
  {
    label: 'Logout',
    icon: 'i-lucide-log-out',
    // async onSelect(_e: Event) {
    //   await logout()
    // },
  },
])
</script>

<template>
  <UDropdownMenu :items>
    <UButton
      color="neutral"
      size="md"
      icon="i-lucide-circle-user"
      variant="link"
    />
  </UDropdownMenu>
</template>
