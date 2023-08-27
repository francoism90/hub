<?php

namespace App\Web\Videos\Controllers;

use App\Web\Videos\Concerns\WithVideo;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\View\View;
use Livewire\Component;

class VideoViewController extends Component
{
    use WithVideo;

    public function mount(): void
    {
        SEOMeta::setTitle($this->video?->name);
    }

    public function render(): View
    {
        return view('videos::view');
    }
}
