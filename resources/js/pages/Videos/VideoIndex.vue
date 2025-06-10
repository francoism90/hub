<script setup lang="ts">
import PageBody from '@/components/Ui/PageBody.vue'
import PageSection from '@/components/Ui/PageSection.vue'
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

    <PageSection
      class="grid gap-3 py-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
    >
      <VideoCard
        v-for="video in videos.data"
        :key="video.id"
        :video
      />
    </PageSection>
  </PageBody>
</template>
