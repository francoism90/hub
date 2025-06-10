<script lang="ts" setup>
import NavMenu from '@/components/Ui/NavMenu.vue'
</script>

<template>
  <UApp>
    <div class="flex h-dvh min-h-dvh flex-col">
      <div class="relative flex justify-center">
        <slot />
        <NavMenu />
      </div>
    </div>
  </UApp>
</template>
