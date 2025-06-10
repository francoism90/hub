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
      <UDrawer
        title="Title"
        description="Description"
        direction="left"
        :handle="false"
        noBodyStyles
      >
        <UButton
          label="Open"
          trailing-icon="i-lucide-chevron-up"
        />

        <template #body>
          <div class="size-full max-w-xs min-w-xs">foo</div>
        </template>
      </UDrawer>
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
