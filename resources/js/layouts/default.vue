<script lang="ts" setup>
import NavBar from '@/components/ui/NavBar.vue'
import NavMenu from '@/components/ui/NavMenu.vue'
</script>

<template>
  <UApp>
    <NavBar />

    <UContainer class="flex min-h-[calc(100vh-var(--ui-header-height))]">
      <main class="flex-1">
        <slot />
      </main>

      <NavMenu />
    </UContainer>
  </UApp>
</template>
