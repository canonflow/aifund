<div class="grid grid-cols-3 gap-x-4 p-2 bg-base-300 rounded">
    @foreach(\App\Enums\LearningType::cases() as $case)
        <button
            wire:click="changeType('{{ $case->value }}')"
            class="btn btn-secondary"
            {{ $case->value == $active ? 'disabled' : '' }}
        >
            {{ \Illuminate\Support\Str::of($case->value)->headline() }}
        </button>
    @endforeach
</div>
