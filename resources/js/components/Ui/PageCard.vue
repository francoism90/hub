<script setup lang="ts">
import type { Video } from '@/types'
import CardActions from './CardActions.vue'
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
      root: 'flex flex-col gap-2 divide-y-0 rounded-none py-4 ring-0',
      header: 'h-60 py-0 sm:h-64 sm:py-0',
      footer: 'py-0',
      body: 'flex flex-col gap-3 py-0 sm:py-0',
    }"
  >
    <template #header>
      <CardImage :item />
    </template>

    <div class="flex flex-col gap-1.5">
      <CardTitle :item />
      <CardLabel :item />
    </div>

    <CardActions :item />
  </UCard>
</template>
