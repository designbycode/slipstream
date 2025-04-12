<?php

namespace App\Livewire\Auth\Logout;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class Button extends Component
{

    public function logout()
    {
        Auth::logout();

        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login');
    }

    public function render(): View
    {
        return view('livewire.auth.logout.button');
    }
}
