<script setup lang="ts">
import { show } from '@/actions/App/Web/Videos/Controllers/VideoController'
import type { Video } from '@/types'
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

interface Props {
  item: Video
}

const props = defineProps<Props>()

const link = computed(() => show.url(props.item.id))
</script>

<template>
  <UCard
    variant="solid"
    :ui="{
      root: 'relative h-52 min-h-52 rounded-2xl bg-gradient-to-t from-neutral-900 to-neutral-800',
      body: 'absolute inset-0 z-0 !p-0',
      footer: 'absolute inset-x-0 bottom-0 z-10 h-14 min-h-14 bg-neutral-200/10 !p-0 backdrop-blur-sm',
    }"
  >
    <Link :href="link">
      <img
        :srcset="item.srcset"
        :src="item.thumbnail"
        :alt="item.name"
        class="h-52 w-full rounded-2xl object-fill"
      />
    </Link>

    <template #footer>
      <div class="flex size-full items-center gap-2 px-4">
        <div class="w-6">
          <UButton
            icon="i-hugeicons-play"
            class="size-6 rounded-full bg-neutral-100/30 p-1 text-neutral-100"
          />
        </div>

        <div class="flex flex-1 flex-col justify-center">
          <span class="line-clamp-1 text-sm leading-none font-medium tracking-tight text-neutral-100">Spiderman: No way home</span>
          <span class="line-clamp-1 text-xs font-light tracking-tight text-neutral-100">Dec 2021</span>
        </div>

        <div class="flex w-20 justify-end gap-3">
          <div class="w-[1px] bg-gradient-to-t from-neutral-100/0 via-neutral-100/25 to-neutral-100/0"></div>
          <UBadge class="rounded-full">
            {{ item.timestamp }}
          </UBadge>
        </div>
      </div>
    </template>
  </UCard>
</template>
