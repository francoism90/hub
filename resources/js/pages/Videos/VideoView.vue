<script setup lang="ts">
import PageBody from '@/components/Ui/PageBody.vue'
import PageCard from '@/components/Ui/PageCard.vue'
import PageList from '@/components/Ui/PageList.vue'
import ToolBar from '@/components/Ui/ToolBar.vue'
import type { Items, Video } from '@/types/model'
import { Head } from '@inertiajs/vue3'

interface Props {
  item: Video
  items?: Items
}

defineProps<Props>()

const navigate = () => window.history.back()
</script>

<template>
  <Head :title="item.name?.en" />

  <PageBody>
    <ToolBar>
      <UButton
        icon="i-lucide-arrow-left"
        color="primary"
        variant="link"
        label="Video"
        class="px-0"
        @click="navigate"
      />
    </ToolBar>

    <PageCard :item />

    <PageList
      variant="compact"
      :items
    />
  </PageBody>
</template>
