<?php

namespace App\Livewire\Ann;

use App\Enums\ActivationFunction;
use App\Enums\LearningType;
use App\Livewire\Forms\AnnForm;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Form extends Component
{
    public AnnForm $form;

    public function init()
    {
        $this->form->validate();
        $this->form->tables = array_fill(0, $this->form->rows, array_fill(0, $this->form->cols, 0));

        // Initial and Output
//        $keys = [];
//        for ($col = 1; $col < $this->form->cols; $col++) array_push($keys, "w{$col}");
//        array_push($keys, "b");
//        $this->form->initial = array_fill_keys($keys, 0);
//        $this->form->output = array_fill_keys($keys, 0);
        $this->form->initial = array_fill(0, $this->form->cols, 0);
        $this->form->output = array_fill(0, $this->form->cols, 0);
    }

    #[On('change-type')]
    public function changeType($type)
    {
        $this->form->reset();
        $this->form->type = $type;
    }


    public function render()
    {
        return view('livewire.ann.form');
    }

    public function calculate()
    {
//        $this->form->output = ActivationFunction::exportFunction($this->form->type);
        $this->form->output = LearningType::calculate(
            $this->form->type,
            $this->form->initial,
            $this->form->tables,
            ActivationFunction::exportFunction($this->form->activation, $this->form->threshold),
            $this->form->learningRate
        );
//        $func = ActivationFunction::exportFunction($this->form->activation, $this->form->threshold);
//        $this->test = $func(5);
    }
}
