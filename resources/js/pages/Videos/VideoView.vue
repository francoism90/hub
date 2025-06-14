<script setup lang="ts">
import VideoViewController from '@/actions/App/Web/Videos/Controllers/VideoViewController'
import PageBody from '@/components/Ui/PageBody.vue'
import PageCard from '@/components/Ui/PageCard.vue'
import PageList from '@/components/Ui/PageList.vue'
import ToolBar from '@/components/Ui/ToolBar.vue'
import type { Items, Video } from '@/types/model'
import { Head, router } from '@inertiajs/vue3'
import type { TabsItem } from '@nuxt/ui'
import { computed, ref } from 'vue'

interface Props {
  tab: string
  item: Video
  items?: Items
}

const props = defineProps<Props>()

const tabs = ref<TabsItem[]>([
  {
    label: 'Related',
    value: 'related',
  },
  {
    label: 'Recommended',
    value: 'recommended',
  },
])

const active = computed({
  get() {
    return props.tab || 'related'
  },

  set(tab) {
    router.get(VideoViewController.url(props.item.id), { tab })
  },
})

const navigate = () => window.history.back()
</script>

<template>
  <Head :title="item.name?.en" />

  <PageBody>
    <div class="sticky top-0 z-50 divide-y divide-default bg-default">
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

      <UTabs
        v-model="active"
        :content="false"
        :items="tabs"
        variant="link"
        :ui="{
          root: 'w-full gap-4 bg-default',
          list: 'h-(--ui-navbar-height)',
          trigger: 'grow',
        }"
      />
    </div>

    <PageList
      variant="compact"
      :items
    />
  </PageBody>
</template>
