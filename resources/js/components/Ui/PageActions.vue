<script setup lang="ts">
interface Props {
  title?: string
  icon?: string
}

defineProps<Props>()
</script>

<template>
  <nav
    class="flex h-(--ui-header-height) w-full items-center justify-between border-b border-b-neutral-500/30 bg-neutral-950 px-4"
  >
    <div class="flex">
      <div
        v-if="title?.length"
        class="inline-flex items-center gap-2 text-neutral-200"
      >
        <UIcon
          v-if="icon"
          :name="icon"
          class="size-5"
        />

        <h1 class="text-lg">
          {{ title }}
        </h1>
      </div>

      <slot name="title" />
    </div>

    <div
      v-if="$slots.actions"
      class="flex items-center gap-1.5"
    >
      <slot name="actions" />
    </div>
  </nav>
</template>
