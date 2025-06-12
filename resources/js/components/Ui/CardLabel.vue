<script setup lang="ts">
import type { Video } from '@/types/model'

interface Props {
  item: Video
}

defineProps<Props>()
</script>

<template>
  <div
    v-if="item.tags"
    class="flex flex-wrap items-center gap-1.5"
  >
    <UBadge
      v-for="tag in item.tags"
      :key="tag.id"
      variant="soft"
    >
      {{ tag.name }}
    </UBadge>
  </div>
</template>
