<script setup lang="ts">
import type { Video } from '@/types/model'

interface Props {
  item: Video
  size?: 'sm' | 'md' | 'lg' | 'xl' | null
}

defineProps<Props>()
</script>

<template>
  <div class="list h-(--ui-action-bar-height) border-t border-default">
    <slot />

    <UButton
      variant="link"
      class="inline-flex items-center gap-0 p-0"
      size="xs"
      label="Edit"
    />

    <UButton
      variant="link"
      class="inline-flex items-center gap-0 p-0"
      size="xs"
      label="Save"
    />
  </div>
</template>
