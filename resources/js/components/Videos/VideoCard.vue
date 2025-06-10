<script setup lang="ts">
import type { Video } from '@/types/model'

interface Props {
  video: Video
}

defineProps<Props>()
</script>

<template>
  <div class="card bg-base-300 w-full">
    <figure class="bg-base-200 h-40"></figure>

    <div class="card-body p-4">
      <h2 class="card-title text-xs font-medium">{{ video.name }}</h2>
      <p v-if="video.summary">{{ video.summary }}</p>
    </div>
  </div>
</template>
