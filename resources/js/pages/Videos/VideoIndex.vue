<script setup lang="ts">
import PageActions from '@/components/Ui/PageActions.vue'
import PageBody from '@/components/Ui/PageBody.vue'
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

  <PageBody>
    <PageActions>
      <template #title>
        <h1 class="text-2xl font-bold">Videos</h1>
      </template>

      <template #actions> <div>foo</div> </template>
    </PageActions>

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
