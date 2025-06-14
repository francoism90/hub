<script setup lang="ts">
import type { Video } from '@/types/model'
import CardImage from './CardImage.vue'
import CardLabel from './CardLabel.vue'
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
      root: 'divide-y-0 rounded-none py-3 ring-0',
      header: 'py-0',
      footer: 'py-0',
      body: 'flex items-center justify-between gap-3 py-0 sm:py-0',
    }"
  >
    <div class="flex flex-1 flex-col gap-1.5">
      <CardTitle :item />
      <CardLabel :item />
    </div>

    <div class="size-24 flex-shrink-0">
      <CardImage :item />
    </div>
  </UCard>
</template>
