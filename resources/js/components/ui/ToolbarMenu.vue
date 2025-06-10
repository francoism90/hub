<template>
  <nav
    class="flex h-14 min-h-14 w-full items-center justify-between gap-2 overflow-x-auto pe-4"
  >
    <div class="inline-flex flex-1">
      <slot name="left" />
    </div>

    <div class="inline-flex">
      <slot name="right" />
    </div>
  </nav>
</template>
