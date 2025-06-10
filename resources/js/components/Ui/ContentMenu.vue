<script lang="ts" setup>
import type { DropdownMenuItem } from '@nuxt/ui'
import { ref } from 'vue'

const items = ref<DropdownMenuItem[]>([
  {
    label: 'New Provider',
    icon: 'i-lucide-plug',
    to: '/providers/new',
  },
])
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
