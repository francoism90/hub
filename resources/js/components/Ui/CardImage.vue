<script setup lang="ts">
import type { Video } from '@/types/model'
import VideoPlayer from './VideoPlayer.vue'

interface Props {
  item: Video
}

defineProps<Props>()
</script>

<template>
  <UModal
    :title="item.name?.en ?? 'Video'"
    :description="item.summary?.en ?? 'Video Player'"
    :ui="{
      overlay: 'bg-black/70',
      content: 'max-h-3/4 w-full max-w-6xl rounded-none bg-transparent ring-0 sm:max-h-3/5',
    }"
  >
    <img
      :src="item.thumbnail"
      :srcset="item.srcset"
      :alt="item.name.en"
      role="img"
      loading="lazy"
      decoding="async"
      class="aspect-auto size-full cursor-pointer rounded border border-default bg-black object-center"
    />

    <template #content>
      <VideoPlayer :url="item.manifest" />
    </template>
  </UModal>
</template>
