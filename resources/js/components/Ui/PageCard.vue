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
      header: 'h-68 pb-0',
      footer: 'p-3',
      body: 'flex flex-col pt-3 sm:pt-3',
    }"
  >
    <template #header>
      <CardImage :item />
    </template>

    <CardTitle :item />
  </UCard>
</template>
