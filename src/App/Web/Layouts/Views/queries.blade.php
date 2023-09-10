<div class="text-gray-400">
    @if ($this->queries->isEmpty())
        <div class="px-4 py-12 text-center">
            {{ __('No recent searches') }}
        </div>
    @else
        <h2 class="p-4 font-medium text-gray-300">
            {{ __('Recent') }}
        </h2>

        <table class="w-full table-auto border-collapse cursor-pointer">
            <tbody>
                @foreach ($this->queries as $query)
                    <tr class="border-y border-gray-700 hover:bg-gray-700">
                        <td class="px-4 py-2" wire:click="$set('form.query', '{{ $query }}')">
                            {{ $query }}
                        </td>

                        <td class="w-12 px-4 py-2">
                            <x-heroicon-o-x-mark class="h-5 w-5" wire:click="removeQuery('{{ $query }}')" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
