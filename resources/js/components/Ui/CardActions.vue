<script setup lang="ts">
import type { Video } from '@/types/model'

interface Props {
  item: Video
}

defineProps<Props>()
</script>

<template>
  <div class="flex items-center gap-4 pt-3">
    <UButton
      icon="i-lucide-heart"
      size="sm"
      variant="link"
      class="inline-flex items-center justify-center px-0"
    />

    <UButton
      icon="i-lucide-heart"
      size="sm"
      variant="link"
      class="inline-flex items-center justify-center px-0"
    />

    <UButton
      icon="i-lucide-heart"
      size="sm"
      variant="link"
      class="inline-flex items-center justify-center px-0"
    />
  </div>
</template>
