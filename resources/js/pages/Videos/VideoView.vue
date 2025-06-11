<script setup lang="ts">
import DiscoverController from '@/actions/App/Web/Account/Controllers/DiscoverController'
import PageBody from '@/components/Ui/PageBody.vue'
import PageCard from '@/components/Ui/PageCard.vue'
import ToolBar from '@/components/Ui/ToolBar.vue'
import type { Video } from '@/types/model'
import { Head, router } from '@inertiajs/vue3'
import type { TabsItem } from '@nuxt/ui'
import { computed, ref } from 'vue'

interface Props {
  item: Video
  tab?: string
}

const props = defineProps<Props>()

const tabs = ref<TabsItem[]>([
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
    router.get(DiscoverController.url(), { tab })
  },
})
</script>

<template>
  <Head :title="item.name?.en" />

  <PageBody>
    <ToolBar>
      <UButton
        :to="DiscoverController.url()"
        variant="link"
        icon="i-lucide-arrow-left"
      >
        Back
      </UButton>
    </ToolBar>

    <PageCard :item />

    <UTabs
      v-model="active"
      :content="false"
      :items="tabs"
      variant="link"
      :ui="{
        root: 'sticky top-0 w-full gap-4 bg-default',
        list: 'h-(--ui-navbar-height)',
        trigger: 'grow',
      }"
    />
  </PageBody>
</template>
