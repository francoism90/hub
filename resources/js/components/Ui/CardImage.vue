<script setup lang="ts">
import type { Video } from '@/types/model'

interface Props {
  item: Video
}

defineProps<Props>()
</script>

<template>
  <div>
    <img
      :src="item.thumbnail"
      :srcset="item.srcset"
      :alt="item.name.en"
      role="img"
      loading="lazy"
      decoding="async"
      class="aspect-video h-56 w-full rounded border border-default bg-black object-center"
    />
  </div>
</template>
