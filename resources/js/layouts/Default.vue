<script lang="ts" setup>
import NavBar from '@/components/Ui/NavBar.vue'
import NavMenu from '@/components/Ui/NavMenu.vue'
</script>

<template>
  <UApp>
    <div class="flex flex-col">
      <NavBar />

      <div
        class="mx-auto flex min-h-[calc(100vh-var(--ui-header-height))] w-full max-w-(--ui-container)"
      >
        <main class="flex-1">
          <slot />
        </main>

        <NavMenu />
      </div>
    </div>
  </UApp>
</template>
