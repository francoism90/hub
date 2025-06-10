<script setup lang="ts">
defineProps({
  title: {
    type: String,
    default: '',
  },
  headline: {
    type: String,
    default: '',
  },
  description: {
    type: String,
    default: '',
  },
})
</script>

<template>
  <nav
    class="flex h-24 min-h-24 w-full max-w-(--ui-container) justify-between py-4 pe-4 sm:pe-6 lg:pe-8"
  >
    <div class="flex flex-col">
      <h2
        v-if="headline"
        class="text-lg font-bold text-neutral-300 uppercase"
      >
        {{ headline }}
      </h2>

      <h1
        v-if="title"
        class="text-2xl font-bold text-neutral-100"
      >
        {{ title }}
      </h1>

      <p
        v-if="description"
        class="text-base text-neutral-400"
      >
        {{ description }}
      </p>
    </div>

    <div class="inline-flex items-center gap-2">
      <slot name="actions" />
    </div>
  </nav>
</template>
