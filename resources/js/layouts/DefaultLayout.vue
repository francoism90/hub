<script lang="ts" setup>
import NavBar from '@/components/Ui/NavBar.vue'
import NavMenu from '@/components/Ui/NavMenu.vue'
</script>

<template>
  <UApp>
    <div class="relative flex h-viewport flex-col items-center justify-center">
      <div class="w-full max-w-4xl">
        <NavBar />

        <div class="flex justify-center">
          <slot />
          <NavMenu />
        </div>
      </div>
    </div>
  </UApp>
</template>
