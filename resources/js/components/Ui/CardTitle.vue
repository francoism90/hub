<script setup lang="ts">
import VideoViewController from '@/actions/App/Web/Videos/Controllers/VideoViewController'
import type { Video } from '@/types/model'
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

interface Props {
  item: Video
}

const props = defineProps<Props>()

const url = computed(() => VideoViewController.url(props.item.id))
const time = computed(() => [props.item.timestamp, props.item.created_human].filter(Boolean).join(' · '))
</script>

<template>
  <Link
    :href="url"
    :class="{
      'pointer-events-none': url == $page.url,
    }"
  >
    <div
      v-if="time"
      class="flex items-center gap-1 text-xs font-medium text-neutral-400"
    >
      {{ time }}
    </div>

    <h2
      v-if="item.name"
      class="line-clamp-2 text-base font-semibold text-neutral-100"
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
