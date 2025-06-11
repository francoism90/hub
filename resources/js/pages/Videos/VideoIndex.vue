<script setup lang="ts">
import VideoIndexController from '@/actions/App/Web/Videos/Controllers/VideoIndexController'
import NavBar from '@/components/Ui/NavBar.vue'
import PageBody from '@/components/Ui/PageBody.vue'
import PageList from '@/components/Ui/PageList.vue'
import VideoCard from '@/components/Videos/VideoCard.vue'
import type { Video } from '@/types/model'
import { Head, router } from '@inertiajs/vue3'
import type { TabsItem } from '@nuxt/ui'
import { computed, ref } from 'vue'

interface Props {
  tab: string
  videos: {
    data: Video[]
  }
}

const props = defineProps<Props>()

const items = ref<TabsItem[]>([
  {
    label: 'Discover',
    value: 'discover',
  },
  {
    label: 'Following',
    value: 'following',
  },
])

const active = computed({
  get() {
    return props.tab || 'discover'
  },

  set(tab) {
    router.get(VideoIndexController.url(), { tab })
  },
})
</script>

<template>
  <Head title="Videos" />

  <PageBody>
    <NavBar />

    {{ props.tab }}

    <UTabs
      v-model="active"
      :content="false"
      :items="items"
      variant="link"
      class="sticky top-0 w-full gap-4 bg-default"
      :ui="{ trigger: 'grow' }"
    />

    <PageList>
      <VideoCard
        v-for="video in videos.data"
        :key="video.id"
        :video
      />
    </PageList>
  </PageBody>
</template>
