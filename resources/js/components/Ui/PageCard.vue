<script setup lang="ts">
import type { Video } from '@/types/model'

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
      header: 'flex flex-col gap-3 pb-0',
      body: 'flex flex-col gap-1.5 !py-3',
      footer: 'flex items-start justify-between gap-2',
    }"
  >
    <template #header>
      <time
        class="flex items-center justify-end gap-2 text-xs font-medium text-neutral-400"
      >
        {{ item.created_human }}
      </time>

      <img
        :src="item.thumbnail"
        :srcset="item.srcset"
        :alt="item.name"
        loading="lazy"
        decoding="async"
        class="aspect-video h-56 w-full rounded border border-default bg-black object-center"
      />
    </template>

    <h2 class="text-base font-semibold text-default">
      {{ item.name }}
    </h2>

    <p
      v-if="item.summary"
      class="line-clamp-3"
    >
      {{ item.summary }}
    </p>

    <div class="flex flex-wrap items-center gap-2">
      <span
        v-for="tag in item.tags"
        :key="tag.id"
        class="text-sm text-neutral-400"
      >
        #{{ tag.name }}
      </span>
    </div>

    <template #footer>
      <UButton
        icon="i-lucide-heart"
        size="sm"
        variant="link"
        class="inline-flex flex-1 items-center justify-center"
      />

      <UButton
        icon="i-lucide-heart"
        size="sm"
        variant="link"
        class="inline-flex flex-1 items-center justify-center"
      />

      <UButton
        icon="i-lucide-heart"
        size="sm"
        variant="link"
        class="inline-flex flex-1 items-center justify-center"
      />
    </template>
  </UCard>
</template>
