<template>
  <UCard
    as="nav"
    :ui="{
      root: 'rounded-none border-b border-default ring-0',
      body: 'flex items-center justify-between py-1.5 sm:py-1.5',
    }"
  >
    <slot />
  </UCard>
</template>
