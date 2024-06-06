<?php

namespace App\Livewire\Ann;

use App\Enums\LearningType;
use Livewire\Component;

class Menu extends Component
{
    public $active = LearningType::HEBB->value;
    public function render()
    {
        return view('livewire.ann.menu');
    }

    public function changeType($type)
    {
        $this->active = $type;
        $this->dispatch('change-type', type: $this->active)
            ->to(Form::class);
    }
}
