import { Livewire, Alpine } from '!/livewire/livewire/dist/livewire.esm'
import intersect from '@alpinejs/intersect'

// Plugins
Alpine.plugin(intersect)

// Vendor
import './vendor'

// Livewire
Livewire.start()
