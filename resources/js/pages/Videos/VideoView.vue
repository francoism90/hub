<script setup lang="ts">
import DiscoverController from '@/actions/App/Web/Account/Controllers/DiscoverController'
import PageBody from '@/components/Ui/PageBody.vue'
import PageCard from '@/components/Ui/PageCard.vue'
import ToolBar from '@/components/Ui/ToolBar.vue'
import type { Video } from '@/types/model'
import { Head } from '@inertiajs/vue3'

interface Props {
  item: Video
}

defineProps<Props>()
</script>

<template>
  <Head :title="item.name?.en" />

  <PageBody>
    <ToolBar>
      <UButton
        :to="DiscoverController.url()"
        variant="link"
        icon="i-lucide-arrow-left"
      >
        Back
      </UButton>
    </ToolBar>

    <PageCard :item />
  </PageBody>
</template>
