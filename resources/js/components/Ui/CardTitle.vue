<script setup lang="ts">
import type { Video } from '@/types/model'
import { computed } from 'vue'

interface Props {
  item: Video
}

const props = defineProps<Props>()

const numbers = computed(() =>
  [props.item.timestamp, props.item.created_human].filter(Boolean).join(' · '),
)
</script>

<template>
  <div class="flex flex-col gap-1">
    <div
      v-if="numbers"
      class="flex items-center gap-1 text-xs font-medium text-neutral-400"
    >
      {{ numbers }}
    </div>

    <h2
      v-if="item.name"
      class="text-base font-semibold"
    >
      {{ item.name }}
    </h2>

    <p
      v-if="item.summary"
      class="line-clamp-3 text-sm text-neutral-300"
    >
      {{ item.summary }}
    </p>
  </div>
</template>
