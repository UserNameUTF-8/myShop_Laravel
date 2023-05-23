<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class header extends Component
{
    /**
     * Create a new component instance.
     */

     private string $name;
     private string $subtitle;
     private string $pathImg;

    public function __construct(string $name, string $subtitle, string $pathImg)
    {
        $this->name = $name;
        $this->subtitle = $subtitle;
        $this->pathImg = $pathImg;
    }
    

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header');
    }
}
