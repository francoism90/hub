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
        variant="link"
        :items="menu"
        :ui="{
          root: 'items-center gap-2',
          list: 'inline-flex size-full items-center gap-4',
          link: 'px-0',
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
