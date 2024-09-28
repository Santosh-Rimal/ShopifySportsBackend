<?php

namespace App\View\Components\admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class sidenavbar extends Component
{
    /**
     * Create a new component instance.
     */
    public $href,$name;
    public function __construct(string $href,string $name)
    {
        $this->name=$name;
        $this->href=$href;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.sidenavbar');
    }
}