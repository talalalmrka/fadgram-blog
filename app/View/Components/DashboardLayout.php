<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class DashboardLayout extends Component
{
    public $title;
    public $actions;
    public function __construct(
        $title = null,
        $actions = null,
    ) {
        $this->title = $title;
        $this->$actions = $actions;
    }
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.dashboard', [
            'title' => $this->title,
            'actions' => $this->actions,
        ]);
    }
}
