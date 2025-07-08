<script setup lang="ts">
import type { Video } from '@/types'
import VideoCard from './VideoCard.vue'

interface Props {
  label: string
  items?: Video[]
}

defineProps<Props>()
</script>

<template>
  <section class="flex flex-col gap-3">
    <div class="flex items-center justify-between">
      <h2 class="font-serif text-lg font-semibold tracking-tight">{{ label }}</h2>
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
