<script setup lang="ts">
import PageSection from '@/components/Ui/PageSection.vue'
import VideoCard from '@/components/Videos/VideoCard.vue'
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

  <PageSection>
    <div class="grid gap-3 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
      <VideoCard
        v-for="video in videos.data"
        :key="video.id"
        :video
      />
    </div>
  </PageSection>
</template>
