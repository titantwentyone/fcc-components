<?php

namespace Titantwentyone\FCCComponents\View\Components\Content;

use Illuminate\View\Component;
use Illuminate\View\View;

class Columns extends Component
{
    public function __construct()
    {
        dd('hello');
    }

    public function render(): View
    {
        dd('rendering');
        return view('fccc::columns');
    }
}
