<script setup lang="ts">
import DiscoverController from '@/actions/App/Web/Account/Controllers/DiscoverController'
import AppLogo from './AppLogo.vue'
</script>

<template>
  <header class="flex h-(--ui-header-height) w-full items-center justify-center bg-default px-4 lg:px-0">
    <ULink :to="DiscoverController.url()">
      <AppLogo />
      <span class="sr-only">Home</span>
    </ULink>
  </header>
</template>
