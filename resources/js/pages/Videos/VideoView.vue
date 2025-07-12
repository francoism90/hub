<script setup lang="ts">
import Page from '@/components/Ui/Page.vue'
import PageBody from '@/components/Ui/PageBody.vue'
import VideoPlayer from '@/components/Video/VideoPlayer.vue'
import type { Playlist, Video } from '@/types'
import { Head } from '@inertiajs/vue3'

interface Props {
  item: Video
  assets: Playlist[]
}

defineProps<Props>()
</script>

<template>
  <Head :title="item.name" />

  <Page>
    <PageBody>
      <VideoPlayer :assets />

      <div class="flex flex-col gap-1 py-3">
        <h1 class="line-clamp-2 font-serif text-xl font-bold">{{ item.name }}</h1>
        <p
          v-if="item.summary?.length"
          class="text-sm text-gray-500"
        />

        {{ assets }}
      </div>
    </PageBody>
  </Page>
</template>
