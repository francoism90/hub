<script setup lang="ts">
import { ref } from 'vue'
import type { NavigationMenuItem } from '@nuxt/ui'

const items = ref(<NavigationMenuItem[][]>[
  [
    {
      label: 'Explore',
      icon: 'i-lucide-compass',
      slot: 'content',
      to: '/',
    },
    {
      label: 'Notifications',
      icon: 'i-lucide-bell',
      slot: 'content',
      to: '/notifications',
    },
    {
      label: 'Collections',
      icon: 'i-lucide-library',
      slot: 'content',
      to: '/collections',
    },
  ],
  [
    {
      label: 'Providers',
      icon: 'i-lucide-plug',
      slot: 'account',
      to: '/providers',
    },
  ],
])
</script>

<template>
  <UNavigationMenu
    orientation="vertical"
    variant="link"
    :items="items"
    :ui="{
      root: 'sticky top-0 flex max-h-dvh h-viewport w-12 items-center overflow-y-auto py-2 lg:w-64 lg:items-stretch lg:px-4',
      link: 'h-10 gap-2.5 px-2',
      linkLabel: 'hidden lg:block',
      separator: 'my-2 bg-primary-500/40',
    }"
  />
</template>
