<script setup lang="ts">
import CommandPalette from '@/components/Ui/CommandPalette.vue'
import ContentMenu from '@/components/Ui/ContentMenu.vue'
import Logo from '@/components/Ui/Logo.vue'
import ProfileMenu from '@/components/Ui/ProfileMenu.vue'
</script>

<template>
  <header
    class="sticky top-0 z-50 flex h-(--ui-header-height) w-full items-center justify-between border-b border-b-neutral-500/30 bg-neutral-950"
  >
    <nav class="flex size-full items-center justify-between gap-3 px-3">
      <div class="inline-flex">
        <Logo />
      </div>

      <div class="inline-flex items-center gap-1.5">
        <CommandPalette />
        <ContentMenu />
        <ProfileMenu />
      </div>
    </nav>
  </header>
</template>
