<?php

namespace App\Videos\Controllers;

use Domain\Videos\Models\Video;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;

class VideoIndexController extends Page
{
    use WithQueryBuilder;

    public function render(): View
    {
        return view('videos.index')->with([
            'video' => $this->video(),
        ]);
    }

    public function refresh(): void
    {
        $this->dispatch('$refesh');
    }

    protected function video(): ?Video
    {
        return $this->getQuery()
            ->published()
            ->inRandomOrder()
            ->first();
    }

    protected static function getModelClass(): ?string
    {
        return Video::class;
    }

    public function getListeners(): array
    {
        $id = static::getAuthKey();

        return [
            "echo-private:user.{$id},.video.deleted" => '$refresh',
            "echo-private:user.{$id},.video.updated" => '$refresh',
        ];
    }
}
