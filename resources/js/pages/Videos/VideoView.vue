<script setup lang="ts">
import PageBody from '@/components/Ui/PageBody.vue'
import PageCard from '@/components/Ui/PageCard.vue'
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
    <PageCard :item />
  </PageBody>
</template>
