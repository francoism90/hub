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
      root: 'divide-y-0 rounded-none ring-0',
      header: 'h-68 pb-0',
      footer: 'p-3',
      body: 'flex flex-col py-0 sm:py-0',
    }"
  >
    <template #header>
      <CardImage :item />
    </template>

    <div class="flex flex-col gap-1.5 py-3">
      <CardTitle :item />
      <CardLabel :item />
    </div>
  </UCard>
</template>
