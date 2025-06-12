<script setup lang="ts">
const navigate = () => window.history.back()
</script>

<template>
  <UButton
    icon="i-lucide-arrow-left"
    color="primary"
    variant="link"
    label="Back"
    class="px-0"
    @click="navigate"
  />
</template>
