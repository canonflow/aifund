<?php

namespace App\Livewire\Ann;

use App\Enums\LearningType;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.ann.index')
            ->layout('layouts.app');
    }
}
