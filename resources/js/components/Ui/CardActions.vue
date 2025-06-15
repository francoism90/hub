<script setup lang="ts">
import type { Video } from '@/types'

interface Props {
  item: Video
}

defineProps<Props>()
</script>

<template>
  <div class="list h-(--ui-action-bar-height) border-t border-default">
    <UButton
      variant="link"
      class="gap-0 p-0"
      size="xs"
      label="Save"
    />

    <UModal :title="item.name || 'Edit Video'">
      <UButton
        v-if="$page.props.auth.user?.roles?.includes('super-admin')"
        variant="link"
        class="gap-0 p-0"
        size="xs"
        label="Edit"
      />

      <template #body> foo </template>
    </UModal>
  </div>
</template>
