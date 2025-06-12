<script setup lang="ts">
import type { Video } from '@/types/model'
import CardActions from './CardActions.vue'

interface Props {
  item: Video
}

defineProps<Props>()
</script>

<template>
  <UModal
    :ui="{
      overlay: 'bg-black/70',
      content:
        'max-h-3/4 w-full max-w-6xl rounded-none bg-transparent ring-0 sm:max-h-3/5',
    }"
  >
    <img
      :src="item.thumbnail"
      :srcset="item.srcset"
      :alt="item.name.en"
      role="img"
      loading="lazy"
      decoding="async"
      class="aspect-video h-64 w-full cursor-pointer rounded border border-default bg-black object-center"
    />

    <template #content>
      <div class="h-dvh w-full rounded-none bg-white">foo</div>
    </template>
  </UModal>
</template>
