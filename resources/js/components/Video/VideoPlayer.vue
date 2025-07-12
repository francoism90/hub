<script setup lang="ts">
import { useShaka } from '@/composables/shaka'
import type { Playlist } from '@/types'
import { computed, onMounted, ref, type PropType } from 'vue'

const props = defineProps({
  assets: {
    type: Object as PropType<Playlist[]>,
    required: false,
  },
})

const ui = ref<HTMLElement | null>()
const element = ref<HTMLMediaElement | null>()

const asset = computed(() => props.assets?.find((item) => item.asset?.length))

onMounted(async () => {
  // Preload video
  const { container, load, attach } = useShaka(asset.value?.asset || '')

  if (element.value && ui.value) {
    // Attach video to container
    await container(ui.value)
    await attach(element.value)

    // Load the video
    await load()
  }
})
</script>

<template>
  <div
    data-shaka-player-container
    ref="ui"
  >
    <video
      data-shaka-player
      class="size-full rounded-2xl bg-black"
      ref="element"
      controls
      playsinline
    />
  </div>
</template>
