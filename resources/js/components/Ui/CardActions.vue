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

    <UModal>
      <UButton
        v-if="item.editable"
        variant="link"
        class="gap-0 p-0"
        size="xs"
        label="Edit"
      />
    </UModal>
  </div>
</template>
