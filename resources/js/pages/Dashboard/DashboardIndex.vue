<script setup lang="ts">
import Page from '@/components/Ui/Page.vue'
import PageBody from '@/components/Ui/PageBody.vue'
import type { Video } from '@/types'

interface Props {
  items?: Video[]
}

defineProps<Props>()
</script>

<template>
  <Page>
    <PageBody> foo </PageBody>
  </Page>
</template>
