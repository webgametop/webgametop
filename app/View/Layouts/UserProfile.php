<?php

declare(strict_types=1);

namespace App\View\Layouts;

use App\Http\Requests\Request;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserProfile extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        private readonly Request $request,
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        /** @var User $user */
        $user = $this->request->user;

        return view('layouts.main', compact('user'));
    }
}
