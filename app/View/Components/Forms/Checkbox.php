<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Checkbox extends Component
{
    public $checked;
    public $name;

    public function __construct($checked = false, $name)
    {
        $this->checked = $checked;
        $this->name = $name;
    }

    public function render()
    {
        return view('components.forms.checkbox');
    }
}

