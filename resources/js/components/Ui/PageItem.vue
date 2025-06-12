<script setup lang="ts">
import type { Video } from '@/types/model'
import CardImage from './CardImage.vue'
import CardTitle from './CardTitle.vue'

interface Props {
  item: Video
}

defineProps<Props>()
</script>

<template>
  <UCard
    as="article"
    :ui="{
      root: 'divide-y-0 rounded-none ring-0',
      header: 'pb-0',
      footer: 'pt-0',
      body: 'flex items-center gap-3 py-3 sm:py-3',
    }"
  >
    <div class="flex-1">
      <CardTitle :item />
    </div>

    <div class="size-24 flex-shrink-0">
      <CardImage :item />
    </div>
  </UCard>
</template>
