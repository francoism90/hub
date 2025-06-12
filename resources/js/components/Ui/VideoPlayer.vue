<script setup lang="ts">
import { useShaka } from '@/composables/shaka'
import { onMounted, ref } from 'vue'

interface Props {
  url?: string
  time?: number
}

const props = defineProps<Props>()

const ui = ref<HTMLElement | null>()
const element = ref<HTMLMediaElement | null>()

onMounted(async () => {
  const { container, load, attach } = useShaka(props.url)

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
  <div ref="ui">
    <video
      ref="element"
      controls
      playsinline
    />
  </div>
</template>
