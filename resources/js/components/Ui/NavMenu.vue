<script setup lang="ts">
import { ref } from 'vue'
import type { NavigationMenuItem } from '@nuxt/ui'
import DiscoverController from '@/actions/App/Web/Account/Controllers/DiscoverController'

const items = ref(<NavigationMenuItem[][]>[
  [
    {
      label: 'Explore',
      icon: 'i-lucide-compass',
      slot: 'content',
      to: DiscoverController.url(),
      exact: true,
    },
    {
      label: 'Search',
      icon: 'i-lucide-search',
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
      label: 'Notifications',
      icon: 'i-lucide-bell',
      slot: 'account',
      to: '/notifications',
    },
    {
      label: 'Account',
      icon: 'i-lucide-circle-user',
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
      root: 'sticky top-0 flex max-h-dvh h-viewport w-12 items-center overflow-y-auto lg:w-64 lg:items-stretch lg:px-4',
      list: 'py-2',
      link: 'h-10 gap-2.5 px-2',
      linkLabel: 'hidden lg:block',
    }"
  />
</template>
