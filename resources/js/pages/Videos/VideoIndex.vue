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
    <PageActions
      title="Videos"
      icon="i-lucide-file-video"
    >
      <template #actions>
        <Link
          href="/videos/create"
          class="btn btn-primary btn-sm"
        >
          <i class="fa-solid fa-plus" />
          Add Video
        </Link>
      </template>
    </PageActions>

    <PageSection
      class="grid gap-3 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
    >
      <VideoCard
        v-for="video in videos.data"
        :key="video.id"
        :video
      />
    </PageSection>
  </PageBody>
</template>
P
