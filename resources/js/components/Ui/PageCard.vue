<script setup lang="ts">
import VideoViewController from '@/actions/App/Web/Videos/Controllers/VideoViewController'
import type { Video } from '@/types/model'
import { Link } from '@inertiajs/vue3'
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
      body: 'flex flex-col gap-2 py-3',
    }"
  >
    <template #header>
      <Link :href="VideoViewController.url(item.id)">
        <CardImage :item />
      </Link>
    </template>

    <CardTitle :item />
    <CardLabel :item />

    <template #footer>
      <CardActions :item />
    </template>
  </UCard>
</template>
