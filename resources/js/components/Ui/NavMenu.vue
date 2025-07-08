<script setup lang="ts">
import type { NavigationMenuItem } from '@nuxt/ui'
import { ref } from 'vue'

const items = ref<NavigationMenuItem[][]>([
  [
    {
      avatar: { icon: 'i-hugeicons-home-10', size: 'lg' },
      to: '/',
    },
  ],
  [
    {
      label: 'Search',
      icon: 'i-hugeicons-search-01',
      to: '/search',
    },
    {
      label: 'Lists',
      icon: 'i-hugeicons-folder-library',
      to: '/lists',
    },
    {
      label: 'Profile',
      icon: 'i-hugeicons-user-02',
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
      list: 'inline-flex size-full items-center gap-4 sm:gap-6',
      link: 'px-0',
      linkLabel: 'sr-only',
      linkTrailingIcon: 'hidden',
    }"
  />
</template>
