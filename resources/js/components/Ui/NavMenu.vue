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
      root: 'sticky top-(--ui-header-height) flex max-h-[calc(100vh-var(--ui-header-height))] w-14 items-center overflow-y-auto border-l border-neutral-500/30 py-2 lg:w-64 lg:items-stretch lg:px-4',
      link: 'h-10 gap-2.5 px-0',
      linkLabel: 'hidden lg:block',
      separator: 'my-2 bg-primary-500/40',
    }"
  />
</template>
