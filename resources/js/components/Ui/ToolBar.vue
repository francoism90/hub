<template>
  <UCard
    as="nav"
    :ui="{
      root: 'sticky top-0 z-30 rounded-none border-b border-default ring-0',
      body: 'flex items-center justify-between py-2 sm:py-2',
    }"
  >
    <slot />
  </UCard>
</template>
