import AssetController from '@/actions/App/Api/Media/Controllers/AssetController'
import SubscriptionController from '@/actions/App/Api/Users/Controllers/SubscriptionController'
import type { Activity, User, Video } from '@/types/model'
import { http } from '@/utils/http'
import { reactive, readonly, shallowRef, toValue, watchEffect, type MaybeRefOrGetter } from 'vue'

export function usActivity(user?: MaybeRefOrGetter<User>) {
  const favorite = (args: Activity) => SubscriptionController.post

  watchEffect(async () => {})

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
