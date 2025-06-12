<script setup lang="ts">
import AppLogo from '@/components/Ui/AppLogo.vue'
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
</script>

<template>
  <Head :title="item.name?.en" />

  <PageBody>
    <ToolBar>
      <UButton
        icon="i-lucide-arrow-left"
        color="primary"
        variant="link"
        label="Back"
        class="px-0"
      />
    </ToolBar>

    <PageCard :item />

    <PageList
      variant="compact"
      :items
    />
  </PageBody>
</template>
