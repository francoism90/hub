<script setup lang="ts">
import { useShaka } from '@/composables/shaka'
import { onMounted, ref } from 'vue'

interface Props {
  url?: string
  time?: number
}

const props = defineProps<Props>()

const element = ref<HTMLElement | null>()
const video = ref<HTMLMediaElement | null>()

onMounted(async () => {
  const { container, load, attach } = useShaka(props.url)

  if (element.value && video.value) {
    // Attach video to container
    await container(element.value)
    await attach(video.value)

    // Load the video
    await load()
  }
})
</script>

<template>
  <div ref="element">
    <video
      ref="video"
      rel="video"
      class="size-full min-h-64 border border-default bg-black object-center lg:rounded"
      loading="lazy"
      decoding="async"
      controls
      playsinline
    />
  </div>
</template>
