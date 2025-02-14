<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class CoverLayout extends Component
{
    public $title;
    public $subtitle;
    public $text;
    public $image;
    public $color;
    public function __construct(
        $title = null,
        $subtitle = null,
        $text = null,
        $image = null,
        $color = 'primary',
    ) {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->text = $text;
        $this->image = $image;
        $this->color = $color;
    }
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.cover', [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'text' => $this->text,
            'image' => $this->image,
            'color' => $this->color,
        ]);
    }
}
