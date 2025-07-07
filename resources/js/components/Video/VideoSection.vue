<script setup lang="ts">
import type { Video } from '@/types'

interface Props {
  label: string
  items?: Video[]
}

defineProps<Props>()
</script>

<template>
  <section class="flex flex-col gap-3">
    <div class="flex items-center justify-between">
      <h2 class="font-serif text-lg font-semibold tracking-tight">{{ label }}</h2>
    </div>

    <div
      v-for="item in items"
      :key="item.id"
    >
      {{ item.name }}
      <!-- {{ item.thumbnail }} -->

      <img
        :src="item.thumbnail"
        :srcset="item.srcset"
        :alt="item.name"
        class="size-32 rounded-lg"
      />
    </div>
  </section>
</template>
