<script setup lang="ts">
import PageBody from '@/components/Ui/PageBody.vue'
import PageCard from '@/components/Ui/PageCard.vue'
import PageList from '@/components/Ui/PageList.vue'
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

    <PageList
      variant="compact"
      :items
    />
  </PageBody>
</template>
