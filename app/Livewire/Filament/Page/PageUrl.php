<?php

namespace App\Livewire\Filament\Page;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class PageUrl extends Component
{

    public $slug;

    public function mount($record = null)
    {
        if ($record) {
            $this->slug = $record->slug;
        }
    }

    public function render()
    {
        return view('livewire.filament.page.page-url');
    }
}
