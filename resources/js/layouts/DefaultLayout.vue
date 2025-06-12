<script lang="ts" setup>
import NavMenu from '@/components/Ui/NavMenu.vue'
</script>

<template>
  <UApp>
    <div class="relative flex h-viewport justify-center">
      <slot />
      <NavMenu />
    </div>
  </UApp>
</template>
