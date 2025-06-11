<script setup lang="ts">
import VideoViewController from '@/actions/App/Web/Videos/Controllers/VideoViewController'
import type { Video } from '@/types/model'
import { Link } from '@inertiajs/vue3'

interface Props {
  item: Video
}

defineProps<Props>()
</script>

<template>
  <UCard
    as="article"
    :ui="{
      root: 'divide-y-0 rounded-none ring-0',
      header: 'flex items-center justify-between gap-2',
      footer: 'flex items-center justify-between gap-2',
      body: 'flex flex-col gap-1',
    }"
  >
    <Link
      :href="VideoViewController.url(item.id)"
      class="flex flex-col gap-2"
    >
      <img
        :src="item.thumbnail"
        :srcset="item.srcset"
        :alt="item.name.en"
        loading="lazy"
        decoding="async"
        class="aspect-video h-56 w-full rounded border border-default bg-black object-center"
      />

      <div class="flex items-center gap-2">
        <time class="text-xs font-medium text-neutral-400">
          {{ item.created_human }}
        </time>
      </div>

      <h2
        v-if="item.name"
        class="text-base font-semibold"
      >
        {{ item.name }}
      </h2>

      <p
        v-if="item.summary"
        class="line-clamp-3 text-neutral-300"
      >
        {{ item.summary }}
      </p>
    </Link>

    <p
      v-if="item.tags"
      class="flex flex-wrap items-center gap-x-2 gap-y-1"
    >
      <span
        v-for="tag in item.tags"
        :key="tag.id"
        class="inline-flex text-sm text-neutral-400"
      >
        #{{ tag.name }}
      </span>
    </p>

    <template #footer>
      <UButton
        icon="i-lucide-heart"
        size="sm"
        variant="link"
        class="inline-flex items-center justify-center px-0"
      />

      <UButton
        icon="i-lucide-heart"
        size="sm"
        variant="link"
        class="inline-flex items-center justify-center px-0"
      />

      <UButton
        icon="i-lucide-heart"
        size="sm"
        variant="link"
        class="inline-flex items-center justify-center px-0"
      />
    </template>
  </UCard>
</template>
