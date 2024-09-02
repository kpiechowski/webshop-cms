<?php

namespace App\Filament\View\Composers;

use App\Repositories\UserRepository;
use Illuminate\View\View;

class HeadingSectionComposer
{
    /**
     * Create a new profile composer.
     */
    public function __construct(
        // protected UserRepository $users,
    ) {
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('count', 2);
    }
}