<?php

namespace App\Filament\Services;

use App\Models\Page;

class PageSectionResolver
{

    public function handle(Page $page)
    {


        $sections = $page->page_sections;
        if (!$sections)
            return null;

        $views = [];
        foreach ($sections as $section) {

            $type = $section['type'];
            $data = $section['data'];

            $views[] = view("partials.sections.$type.$type", )->with($data)->render();
        }

        return $views;


    }

}