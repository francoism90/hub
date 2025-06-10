<script lang="ts" setup>
const { isAuthenticated } = useSanctumAuth()
</script>

<template>
  <template v-if="isAuthenticated">
    <div>
      <NavBar />

      <UContainer class="flex min-h-[calc(100vh-var(--ui-header-height))]">
        <main class="flex-1">
          <slot />
        </main>

        <NavMenu />
      </UContainer>
    </div>
  </template>
</template>
