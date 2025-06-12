<script setup lang="ts">
import VideoViewController from '@/actions/App/Web/Videos/Controllers/VideoViewController'
import type { Video } from '@/types/model'
import { Link } from '@inertiajs/vue3'
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
  <Link
    :href="VideoViewController.url(item.id)"
    class="flex flex-col gap-1 py-3"
  >
    <div
      v-if="numbers"
      class="flex items-center gap-1 text-xs font-medium text-neutral-400"
    >
      {{ numbers }}
    </div>

    <h2
      v-if="item.name"
      class="line-clamp-3 text-base font-semibold text-neutral-100"
    >
      {{ item.name }}
    </h2>

    <p
      v-if="item.summary"
      class="line-clamp-3 text-sm text-neutral-300"
    >
      {{ item.summary }}
    </p>
  </Link>
</template>
