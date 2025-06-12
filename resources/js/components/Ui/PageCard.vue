<script setup lang="ts">
import type { Video } from '@/types/model'
import CardImage from './CardImage.vue'
import CardTitle from './CardTitle.vue'
import CardLabel from './CardLabel.vue'
import CardActions from './CardActions.vue'

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
      body: 'flex flex-col py-0 sm:py-0',
    }"
  >
    <template #header>
      <CardImage :item />
    </template>

    <CardTitle :item />
    <CardLabel :item />

    <template #footer>
      <CardActions :item />
    </template>
  </UCard>
</template>
