<script setup lang="ts">
import type { Video } from '@/types/model'

interface Props {
  item: Video
}

defineProps<Props>()
</script>

<template>
  <UCard>
    <template #header>
      {{ item.name }}
    </template>
  </UCard>
</template>
