<script setup lang="ts">
import type { Items } from '@/types/model'
import { Deferred, WhenVisible } from '@inertiajs/vue3'
import { computed } from 'vue'
import PageItem from './PageItem.vue'
import PageCard from '@/components/Ui/PageCard.vue'

interface Props {
  items?: Items
  variant?: 'default' | 'compact'
}

const props = defineProps<Props>()

const component = computed(() => (props.variant === 'compact' ? PageItem : PageCard))
const hasMorePages = computed(() => (props.items?.links?.next || props.items?.next_page_url) !== null)
const currentPage = computed(() => props.items?.meta?.current_page || props.items?.current_page || 1)
</script>

<template>
  <div class="grid grid-cols-1 divide-y divide-default">
    <Deferred data="items">
      <template #fallback>
        <div class="sr-only">Loading items...</div>
      </template>

      <div
        v-for="item in items?.data"
        :key="item.id"
      >
        <component
          :is="component"
          :item="item"
        />
      </div>

      <WhenVisible
        :always="hasMorePages"
        :params="{
          only: ['items'],
          data: { page: currentPage + 1 },
        }"
      >
        <template #fallback>
          <div class="sr-only">Loading more...</div>
        </template>

        <div class="flex h-(--ui-navbar-height) items-center justify-center text-sm font-medium text-neutral-400">
          <template v-if="!hasMorePages">
            <span>You reached the end!</span>
          </template>

          <template v-else>
            <span>Loading more items...</span>
          </template>
        </div>
      </WhenVisible>
    </Deferred>
  </div>
</template>
