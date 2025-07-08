<script setup lang="ts">
import type { Video } from '@/types'
import type { NavigationMenuItem } from '@nuxt/ui'
import VideoCard from './VideoCard.vue'

interface Props {
  label: string
  menu?: NavigationMenuItem[]
  items?: Video[]
}

defineProps<Props>()
</script>

<template>
  <section class="flex flex-col gap-3">
    <div class="flex items-center justify-between gap-3">
      <h2 class="font-serif text-lg font-semibold tracking-tight">{{ label }}</h2>

      <UNavigationMenu
        v-if="menu"
        :items="menu"
        :ui="{
          root: 'flex items-center gap-2',
          item: 'text-sm font-medium text-neutral-500 hover:text-neutral-700',
        }"
      />
    </div>

    <UCarousel
      v-slot="{ item }"
      :items="items"
      :ui="{
        item: 'basis-xs md:basis-2/4 lg:basis-sm',
      }"
    >
      <VideoCard :item />
    </UCarousel>
  </section>
</template>
