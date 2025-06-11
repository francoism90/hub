<script setup lang="ts">
import PageCard from '@/components/Ui/PageCard.vue'
import type { Items } from '@/types/model'
import { Deferred, WhenVisible } from '@inertiajs/vue3'
import { computed } from 'vue'

interface Props {
  items: Items
}

const props = defineProps<Props>()

const hasMorePages = computed(() => props.items.links?.next !== null)
const currentPage = computed(() => props.items.meta?.current_page || 1)
</script>

<template>
  <div class="grid grid-cols-1 divide-y divide-default">
    <Deferred data="items">
      <template #fallback>
        <div class="sr-only">Loading...</div>
      </template>

      <PageCard
        v-for="item in items.data"
        :key="item.id"
        :item
      />
    </Deferred>

    <WhenVisible
      :always="hasMorePages"
      :params="{
        data: { page: currentPage + 1 },
        only: ['items'],
      }"
    >
      {{ hasMorePages }}
    </WhenVisible>
  </div>
</template>
