<script lang="ts" setup>
definePageMeta({
  middleware: ['sanctum:auth'],
})

useSeoMeta({
  title: 'Dashboard',
})
</script>

<template>
  <div>index</div>
</template>
