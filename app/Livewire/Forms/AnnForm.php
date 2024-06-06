<?php

namespace App\Livewire\Forms;

use App\Enums\ActivationFunction;
use App\Enums\LearningType;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AnnForm extends Form
{
    public $type = LearningType::HEBB->value;
    #[Rule('min:2|numeric')]
    public $rows = 3;
    #[Rule('min:2|numeric')]
    public $cols = 3;

    // Table Input
    public $tables = [
        [0, 0, 0],
        [0, 0, 0],
        [0, 0, 0]
    ];

    // Initial
    public $initial = [0, 0, 0];

    // Output
    public $output = [0, 0, 0];

    #[Rule('required')]
    public $activation = ActivationFunction::BINARY_HARD->value;
    public $learningRate = 0.1;
    public $threshold = 1;

}
