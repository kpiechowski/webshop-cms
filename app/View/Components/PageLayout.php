<?php

namespace App\View\Components;

use App\Models\ThemeOption;
use Illuminate\View\Component;
use Illuminate\View\View;

class PageLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {

        $data = [
            'site_name' => ThemeOption::value('site_name'),
            'meta_description' => ThemeOption::value('site_description'),
        ];



        return view('layouts.page', )->with($data);
    }
}
