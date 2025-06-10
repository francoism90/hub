<script setup lang="ts">
import AppLogo from './AppLogo.vue'
import CommandPalette from './CommandPalette.vue'
import ProfileMenu from './ProfileMenu.vue'
</script>

<template>
  <header
    class="sticky top-0 z-30 flex h-(--ui-header-height) w-full items-center justify-between bg-default px-4 lg:px-0"
  >
    <div class="inline-flex">
      <AppLogo />
    </div>

    <div class="inline-flex">
      <div class="flex items-center gap-1.5">
        <CommandPalette />
        <ProfileMenu />
      </div>
    </div>
  </header>
</template>
