<script setup lang="ts">
import VideoViewController from '@/actions/App/Web/Videos/Controllers/VideoViewController'
import type { Video } from '@/types'
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

interface Props {
  item: Video
}

const props = defineProps<Props>()

const url = computed(() => VideoViewController.url(props.item.id))
</script>

<template>
  <Link
    :href="url"
    class="flex flex-col gap-0.5"
    :class="{
      'pointer-events-none': url == $page.url,
    }"
  >
    <div class="list text-xs font-medium text-neutral-400 *:after:mx-1">
      <span v-if="item.timestamp">{{ item.timestamp }}</span>
      <span v-if="item.published">{{ item.published }}</span>
    </div>

    <h2 class="line-clamp-2 text-base font-semibold text-neutral-100">
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
