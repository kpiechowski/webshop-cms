<?php

namespace App\Livewire\Filament\Page;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class PageUrl extends Component
{

    public $slug;

    protected $listeners = ['slugUpdated' => 'updateUrl'];

    public function updateUrl($slug)
    {
        $this->slug = $slug;
    }

    public function mount(?Model $record = null)
    {
        if ($record) {
            $this->slug = $record->slug;
        }
    }

    public function updatedSlug()
    {
        dd($this->slug);
    }

    public function render()
    {
        return view('livewire.filament.page.page-url', ['slug' => $this->slug]);
    }
}
