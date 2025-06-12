<script setup lang="ts">
import DiscoverController from '@/actions/App/Web/Account/Controllers/DiscoverController'
import AppLogo from '@/components/Ui/AppLogo.vue'
</script>

<template>
  <ULink :to="DiscoverController.url()">
    <AppLogo />
  </ULink>
</template>
