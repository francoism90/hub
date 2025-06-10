<template>
  <nav
    class="sticky top-(--ui-header-height) z-50 flex h-(--ui-header-height) w-full items-center justify-between border-b border-b-neutral-500/30 bg-neutral-950 px-4 lg:border-none"
  >
    <div class="inline-flex items-center gap-2">
      <slot name="title" />
    </div>

    <div class="inline-flex items-center gap-2">
      <slot name="actions" />
    </div>
  </nav>
</template>
