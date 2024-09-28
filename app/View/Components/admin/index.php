<?php

namespace App\View\Components\admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class index extends Component
{
    /**
     * Create a new component instance.
     */
    public $class1,$class2,$class3,$value,$name;
    public function __construct(string $class1,string $class2,string $class3,string $value,string $name)
    {
        $this->class1=$class1;
        $this->class2=$class2;
        $this->class3=$class3;
        $this->name=$name;
        $this->value=$value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.index');
    }
}