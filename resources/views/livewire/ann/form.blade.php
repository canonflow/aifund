<div>
    <form class="grid grid-cols-2 mb-4 gap-4" wire:submit="init()">
        <label class="form-control w-full">
            <div class="label">
                <span class="label-text font-bold">Rows</span>
            </div>
            <input
                wire:model="form.rows"
                type="number" placeholder="Type here" class="input input-bordered w-full"
                min="2"
                max="12"
            />
            @error('form.rows')
            <div class="label">
                <span class="label-text text-red-500">{{ $message }}</span>
            </div>
            @enderror
        </label>
        <label class="form-control w-full">
            <div class="label">
                <span class="label-text font-bold">Cols</span>
            </div>
            <input
                wire:model="form.cols"
                type="number" placeholder="Type here" class="input input-bordered w-full"
                min="2"
                max="12"
            />
            @error('form.cols')
            <div class="label">
                <span class="label-text text-red-500">{{ $message }}</span>
            </div>
            @enderror
        </label>
        <button class="btn btn-success col-span-2 col-start-2">Initialize</button>
    </form>
    <form action="" wire:submit="calculate()">
        <div class="bg-base-200 p-3 rounded">
            <div class="mb-3 grid grid-cols-3 gap-4">
                {{--  Activation Function  --}}
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text font-bold">Activation Function</span>
                    </div>
                    <select class="select select-bordered select-info" wire:model.live="form.activation">
                        @foreach(\App\Enums\ActivationFunction::cases() as $case)
                            <option value="{{ $case->value }}">{{ \Illuminate\Support\Str::of($case->value)->headline() }}</option>
                        @endforeach
                    </select>
                </label>

                {{--  Threshold  --}}
                @if(in_array($form->activation, [\App\Enums\ActivationFunction::BINARY_THRESH->value, \App\Enums\ActivationFunction::BIPOLAR_THRESH->value]))
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-bold">Threshold</span>
                        </div>
                        <input
                            wire:model="form.threshold"
                            type="number" placeholder="Type here" class="input input-bordered w-full"
                        />
                    </label>
                @endif

                {{--  Learning Rate  --}}
                @if(!($form->type == \App\Enums\LearningType::HEBB->value))
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-bold">Learning Rate</span>
                        </div>
                        <input
                            wire:model="form.learningRate"
                            type="number" placeholder="Type here" class="input input-bordered w-full"
                            min="0"
                            step="any"
                            max="1"
                        />
                    </label>
                @endif
            </div>

            {{--  Tables  --}}
            <div class="grid grid-cols-{{ $form->cols }} gap-4 mb-10 ">
                @foreach($form->initial as $key => $value)
                    @php
                        $header = ($key < $form->cols - 1) ? "W" . $key + 1 : "B" ;
                    @endphp
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-bold">{{ strtoupper($header) }}</span>
                        </div>
                        <input
                            wire:model.live="form.initial.{{ $key }}"
                            type="number" placeholder="Type here" class="input input-bordered w-full"
                            step="any"
                        />
                    </label>
                @endforeach
            </div>
            @foreach($form->tables as $row => $items)
                <div class="grid grid-cols-{{ $form->cols }} gap-4 mb-3">
                    @foreach($items as $idx => $item)
                        <input
                            wire:model="form.tables.{{ $row }}.{{ $idx }}"
                            type="number"
                            class="input input-bordered"
                        >
                    @endforeach
                </div>
            @endforeach
            <button class="btn btn-primary mt-3" wire:loading.attr="disabled">Calculate</button>
        </div>
    </form>
    <div class="mt-5 bg-neutral text-neutral-content p-3 rounded text-lg">
        <table>
            @foreach($form->output as $idx => $value)
                <tr>
                    @php
                        $header = ($idx < $form->cols - 1) ? "W" . $idx + 1 : "B" ;
                    @endphp
                    <td>{{ $header }}</td>
                    <td class="px-3">:</td>
                    <td>{{ $value }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
