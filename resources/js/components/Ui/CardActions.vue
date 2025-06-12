<script setup lang="ts">
import type { Video } from '@/types/model'
import { computed } from 'vue'

interface Props {
  item: Video
  size?: 'sm' | 'md' | 'lg' | 'xl' | null
}

const props = defineProps<Props>()
const size = computed(() => props.size ?? 'sm')
</script>

<template>
  <div class="flex items-center gap-3 pt-3">
    <UButton
      icon="i-lucide-heart"
      variant="link"
      class="inline-flex items-center justify-center px-0"
      :size
    />

    <UButton
      icon="i-lucide-heart"
      variant="link"
      class="inline-flex items-center justify-center px-0"
      :size
    />

    <UButton
      icon="i-lucide-heart"
      variant="link"
      class="inline-flex items-center justify-center px-0"
      :size
    />
  </div>
</template>
