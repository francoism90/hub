import shaka from 'shaka-player/dist/shaka-player.ui'
import { readonly, shallowRef, toValue, watchEffect, type MaybeRefOrGetter } from 'vue'

export function useShaka(url?: MaybeRefOrGetter<string>, time?: MaybeRefOrGetter<number>) {
  const player = shallowRef<shaka.Player>()
  const manager = shallowRef<shaka.media.PreloadManager | null>()
  const events = shallowRef<shaka.util.EventManager | null>()

  const preload = async (assetUri: string, startTime?: number) => player.value?.preload(assetUri, startTime)

  const load = async (assetUri?: string, startTime?: number) => player.value?.load(assetUri ?? manager.value ?? '', startTime)

  const unload = async () => player.value?.unload()

  const container = async (el: HTMLElement | null) => player.value?.setVideoContainer(el)

  const attach = async (el: HTMLMediaElement) => player.value?.attach(el)

  const detach = async () => player.value?.detach()

  const destroy = async () => player.value?.destroy()

  watchEffect(async () => {
    // Install polyfills
    shaka.polyfill.installAll()

    // Check browser support
    if (!shaka.Player.isBrowserSupported()) {
      console.error('Browser not supported')
      return
    }

    // Setup player and events
    player.value = new shaka.Player()
    events.value = new shaka.util.EventManager()

    // Setup preload manager
    if (url) {
      manager.value = await preload(toValue(url), toValue(time))
    }
  })

  return {
    load,
    unload,
    container,
    attach,
    detach,
    destroy,
    events: readonly(events),
    state: readonly(player),
  }
}
