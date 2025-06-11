<script setup lang="ts">
import DiscoverController from '@/actions/App/Web/Account/Controllers/DiscoverController'
import PageBody from '@/components/Ui/PageBody.vue'
import ToolBar from '@/components/Ui/ToolBar.vue'
import type { Video } from '@/types/model'
import { Head, Link } from '@inertiajs/vue3'

interface Props {
  video: Video
}

defineProps<Props>()
</script>

<template>
  <Head :title="video.name?.en" />

  <PageBody>
    <ToolBar>
      <Link
        :href="DiscoverController.url()"
        class="inline-flex w-full items-center gap-2 text-neutral-400"
      >
        <UIcon name="i-lucide-arrow-left" />
        Back
      </Link>
    </ToolBar>

    {{ video.name }}
  </PageBody>
</template>
