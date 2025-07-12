<script setup lang="ts">
import { useShaka } from '@/composables/shaka'
import type { Transcode } from '@/types'
import { computed, onMounted, ref, type PropType } from 'vue'

const props = defineProps({
  assets: {
    type: Object as PropType<Transcode[]>,
    required: false,
  },
})

const ui = ref<HTMLElement | null>()
const element = ref<HTMLMediaElement | null>()

const asset = computed(() => props.assets?.find((asset) => asset.asset.length))

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
    class="relative size-full"
    ref="ui"
  >
    <video
      data-shaka-player
      class="size-full"
      ref="element"
      controls
      playsinline
    />
  </div>
</template>
