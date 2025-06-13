<script setup lang="ts">
import HistoryBack from '@/components/Actions/HistoryBack.vue'
import NavBar from '@/components/Ui/NavBar.vue'
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
    <PageCard :item />

    <ToolBar>
      <HistoryBack />
    </ToolBar>

    <PageList
      variant="compact"
      :items
    />
  </PageBody>
</template>
