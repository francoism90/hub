<script setup lang="ts">
import DiscoverController from '@/actions/App/Web/Account/Controllers/DiscoverController'
import NavBar from '@/components/Ui/NavBar.vue'
import PageBody from '@/components/Ui/PageBody.vue'
import PageList from '@/components/Ui/PageList.vue'
import type { Items } from '@/types/model'
import { Head, router } from '@inertiajs/vue3'
import type { TabsItem } from '@nuxt/ui'
import { computed, ref } from 'vue'

interface Props {
  tab: string
  items?: Items
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
  <Head title="Videos" />

  <PageBody>
    <NavBar />

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

    <PageList
      v-if="items"
      :items
    />
  </PageBody>
</template>
