<script setup lang="ts">
import NavBar from '@/components/Ui/NavBar.vue'
import PageBody from '@/components/Ui/PageBody.vue'
import PageList from '@/components/Ui/PageList.vue'
import VideoCard from '@/components/Videos/VideoCard.vue'
import type { Video } from '@/types/model'
import { Head, router, usePage } from '@inertiajs/vue3'
import type { TabsItem } from '@nuxt/ui'
import { computed, ref } from 'vue'

interface Props {
  videos: {
    data: Video[]
  }
}

defineProps<Props>()

const page = usePage()

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
    return (page.props.tab as string) || 'discover'
  },

  set(tab) {
    router.get('/', { tab }, { replace: true })
  },
})
</script>

<template>
  <Head title="Videos" />

  <PageBody>
    <NavBar />

    <UTabs
      v-model="active"
      :content="false"
      :items="items"
      variant="link"
      class="w-full gap-4"
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
