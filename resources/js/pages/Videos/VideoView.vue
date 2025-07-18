<script setup lang="ts">
import Page from '@/components/Ui/Page.vue'
import PageBody from '@/components/Ui/PageBody.vue'
import VideoNavigation from '@/components/Video/VideoNavigation.vue'
import VideoPlayer from '@/components/Video/VideoPlayer.vue'
import VideoSection from '@/components/Video/VideoSection.vue'
import type { Playlist, Video } from '@/types'
import { Deferred, Head } from '@inertiajs/vue3'
import { useEcho } from '@laravel/echo-vue'
import { computed } from 'vue'

interface Props {
  item: Video
  manifests: Playlist[]
  queue?: Video[]
}

const props = defineProps<Props>()

const channel = computed(() => `videos.${props.item.id}`)

useEcho<Video>(channel.value, 'video.updated', (e: unknown) => {
  console.log(e)
})
</script>

<template>
  <Head :title="item.name" />

  <Page>
    <PageBody>
      <VideoPlayer :manifests />

      <div class="flex flex-col gap-1.5">
        <h1 class="line-clamp-2 font-serif font-semibold tracking-tight">{{ item.name }}</h1>
        <p
          v-if="item.summary?.length"
          class="text-sm text-neutral-500"
        />

        <VideoNavigation :item />
      </div>

      <Deferred :data="['queue']">
        <template #fallback>
          <div class="sr-only">Loading sections...</div>
        </template>

        <VideoSection
          v-if="queue?.length"
          label="Up Next"
          :items="queue"
        />
      </Deferred>
    </PageBody>
  </Page>
</template>
