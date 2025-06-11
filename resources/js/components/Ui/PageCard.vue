<script setup lang="ts">
import type { Video } from '@/types/model'

interface Props {
  item: Video
}

defineProps<Props>()
</script>

<template>
  <UCard
    :ui="{
      root: 'divide-y-0 rounded-none ring-0',
      body: '!py-0',
      header: 'flex items-center justify-between',
    }"
  >
    <template #header>
      <div class="flex flex-col">
        <span class="text-default">{{ item.name }}</span>
        <span class="text-xs text-neutral-300">{{ item.timestamp }}</span>
      </div>

      <div class="flex items-center gap-2">
        <span class="text-xs text-neutral-400">{{ item.updated_human }}</span>
      </div>
    </template>

    <img
      :src="item.thumbnail"
      :srcset="item.srcset"
      :alt="item.name"
      loading="lazy"
      decoding="async"
      class="aspect-video h-56 w-full rounded border border-default bg-black object-center"
    />

    <template #footer>
      <Placeholder class="h-8" />
    </template>
  </UCard>
</template>
