<script setup lang="ts">
import { show } from '@/actions/App/Web/Videos/Controllers/VideoController'
import type { Video } from '@/types'
import { Link } from '@inertiajs/vue3'
import { computed, ref } from 'vue'

interface Props {
  item: Video
}

const props = defineProps<Props>()

const hover = ref<boolean>(false)

const link = computed(() => show.url(props.item.id))
</script>

<template>
  <UCard
    variant="solid"
    :ui="{
      root: 'relative h-52 min-h-52 rounded-2xl bg-transparent',
      body: 'absolute inset-0 z-0 !p-0',
    }"
  >
    <Link :href="link">
      <div class="absolute inset-0 z-10 size-full bg-gradient-to-t from-neutral-800/30 to-transparent" />

      <img
        :srcset="item.srcset"
        :src="item.thumbnail"
        :alt="item.name"
        class="h-52 w-full rounded-2xl object-fill"
        loading="lazy"
      />

      <div class="absolute inset-x-4 bottom-6 z-10">
        <div class="flex flex-col">
          <h2 class="line-clamp-1 text-sm font-medium tracking-tight text-neutral-100">Spiderman: No way home</h2>
          <p class="line-clamp-1 text-xs font-light tracking-tight text-neutral-100">
            {{ item.timestamp }}
          </p>
        </div>
      </div>
    </Link>
  </UCard>
</template>
