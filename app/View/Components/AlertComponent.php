<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AlertComponent extends Component
{
    public $type,$message;
    public function __construct($type='success',$message="Thanh cong!")
    {
        $this->type = $type;
        $this->message = $message;
    }

    public function render()
    {
        return view('components.alert-component');
    }
}