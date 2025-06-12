<script setup lang="ts">
import type { Video } from '@/types/model'

interface Props {
  item: Video
}

defineProps<Props>()
</script>

<template>
  <UModal
    :fullscreen="true"
    :ui="{
      header: 'absolute top-0 right-0 z-50',
      content: 'divide-y-0 bg-black/70',
      body: 'flex w-full items-center bg-transparent p-0 sm:p-0',
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

    <template #body>
      <div class="size-full max-h-3/5 bg-white">foo</div>
    </template>
  </UModal>
</template>
