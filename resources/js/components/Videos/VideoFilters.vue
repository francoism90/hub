<script setup lang="ts">
import PageActions from '@/components/Ui/PageActions.vue'
</script>

<template>
  <PageActions>
    <UCollapsible class="flex w-full flex-col">
      <UButton
        label="Filters"
        color="neutral"
        variant="link"
        class="w-full p-3"
        icon="i-lucide-list-filter"
      />

      <template #content>
        <div class="w-full border-t border-t-neutral-500/30 p-3">foo</div>
      </template>
    </UCollapsible>
  </PageActions>
</template>
