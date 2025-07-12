<script setup lang="ts">
import Page from '@/components/Ui/Page.vue'
import PageBody from '@/components/Ui/PageBody.vue'
import VideoPlayer from '@/components/Video/VideoPlayer.vue'
import type { Transcode, Video } from '@/types'
import { Head } from '@inertiajs/vue3'

interface Props {
  item: Video
  assets: Transcode[]
}

defineProps<Props>()
</script>

<template>
  <Head :title="item.name" />

  <Page>
    <PageBody>
      <VideoPlayer :assets />

      {{ item.name }}
      {{ assets }}
    </PageBody>
  </Page>
</template>
