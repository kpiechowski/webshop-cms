<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Filament\Services\PageSectionResolver;

class PageController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function home(Page $page)
    {
        return view('welcome');
    }


    public function show(Page $page, PageSectionResolver $resolver)
    {

        if (!$page)
            return redirect('home');


        $sections = $resolver->handle($page);

        return view('pages.show', compact('sections'));
        // dd($sections);


    }
}
