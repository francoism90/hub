<script setup lang="ts">
import type { Video } from '@/types'

interface Props {
  title?: string
  description?: string
  items?: Video[]
}

defineProps<Props>()
</script>

<template>
  <UCarousel
    v-slot="{ item }"
    :items="items"
    :ui="{ item: 'basis-1/3' }"
  >
    <img
      :src="item"
      width="234"
      height="234"
      class="rounded-lg"
    />
  </UCarousel>
</template>
