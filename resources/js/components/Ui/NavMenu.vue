<script setup lang="ts">
import type { NavigationMenuItem } from '@nuxt/ui'
import { ref } from 'vue'

const items = ref<NavigationMenuItem[][]>([
  [
    {
      avatar: { icon: 'i-lucide-home', size: 'lg' },
      to: '/',
    },
  ],
  [
    {
      label: 'Search',
      icon: 'i-lucide-search',
      to: '/search',
    },
    {
      label: 'Lists',
      icon: 'i-lucide-library',
      to: '/lists',
    },
    {
      label: 'Profile',
      icon: 'i-lucide-user',
      to: '/profile',
    },
  ],
])
</script>

<template>
  <UNavigationMenu
    orientation="horizontal"
    variant="link"
    :items="items"
    :ui="{
      root: 'size-full items-center',
      list: 'inline-flex size-full items-center gap-4',
      link: 'px-0',
      linkLabel: 'sr-only',
      linkTrailingIcon: 'hidden',
    }"
  />
</template>
