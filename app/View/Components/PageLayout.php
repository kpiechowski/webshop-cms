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

        $site_name = ThemeOption::value('site_name');

        return view('layouts.page', compact('site_name'));
    }
}
