<script setup lang="ts">
import Page from '@/components/Ui/Page.vue'
import PageBody from '@/components/Ui/PageBody.vue'
import type { Video } from '@/types'
import { Head } from '@inertiajs/vue3'

interface Props {
  item: Video
}

defineProps<Props>()
</script>

<template>
  <Head :title="item.name" />

  <Page>
    <PageBody> {{ item.name }}</PageBody>
  </Page>
</template>
