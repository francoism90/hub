<script setup lang="ts">
import PageBody from '@/components/Ui/PageBody.vue'
import PageList from '@/components/Ui/PageList.vue'
import VideoCard from '@/components/Videos/VideoCard.vue'
import VideoFilters from '@/components/Videos/VideoFilters.vue'
import { Head } from '@inertiajs/vue3'

defineProps({
  videos: {
    type: Object,
    required: true,
  },
})
</script>

<template>
  <Head title="Videos" />

  <PageBody>
    <VideoFilters />

    <PageList>
      <VideoCard
        v-for="video in videos.data"
        :key="video.id"
        :video
      />
    </PageList>
  </PageBody>
</template>
