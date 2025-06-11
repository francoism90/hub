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
      root: 'divide-y-0 rounded-none py-1 ring-0',
      header: 'flex items-center justify-end gap-2 py-3',
      body: 'flex flex-col gap-3 p-3 !py-0',
      footer: 'flex items-center justify-start gap-2 py-3',
    }"
  >
    <template #header>
      <time class="text-xs font-medium text-neutral-400">
        {{ item.created_human }}
      </time>
    </template>

    <img
      :src="item.thumbnail"
      :srcset="item.srcset"
      :alt="item.name"
      loading="lazy"
      decoding="async"
      class="aspect-video h-56 w-full rounded border border-default bg-black object-center"
    />

    <h2 class="text-base font-semibold text-default">
      {{ item.name }}
    </h2>

    <p
      v-if="item.summary"
      class="line-clamp-3"
    >
      {{ item.summary }}
    </p>

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
        class="inline-flex items-center justify-center"
      />

      <UButton
        icon="i-lucide-heart"
        size="sm"
        variant="link"
        class="inline-flex items-center justify-center"
      />

      <UButton
        icon="i-lucide-heart"
        size="sm"
        variant="link"
        class="inline-flex items-center justify-center"
      />
    </template>
  </UCard>
</template>
