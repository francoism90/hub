<script setup lang="ts">
import type { NavigationMenuItem } from '@nuxt/ui'
import { ref } from 'vue'

const items = ref<NavigationMenuItem[][]>([
  [
    {
      label: 'Stry',
      to: '/',
      ui: {
        linkLabel: 'font-serif text-neutral-300 font-bold uppercase',
      },
    },
  ],
  [
    {
      label: 'Search',
      icon: 'i-hugeicons-search-01',
      to: '/search',
      ui: {
        linkLabel: 'sr-only',
      },
    },
    {
      label: 'Lists',
      icon: 'i-hugeicons-folder-library',
      to: '/lists',
      ui: {
        linkLabel: 'sr-only',
      },
    },
    {
      label: 'Profile',
      icon: 'i-hugeicons-user-02',
      to: '/profile',
      ui: {
        linkLabel: 'sr-only',
      },
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
      linkTrailingIcon: 'hidden',
    }"
  />
</template>
