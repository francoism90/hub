<script setup lang="ts">
import PageBody from '@/components/Ui/PageBody.vue'
import type { Video } from '@/types/model'
import { Head } from '@inertiajs/vue3'

interface Props {
  video: Video
}

defineProps<Props>()
</script>

<template>
  <Head :title="video.name?.en" />

  <PageBody>
    {{ video.name }}
  </PageBody>
</template>
