<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Artificial Neural Network') }}
        </h2>
    </x-slot>

    {{--  Container  --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg bg-primary mb-5">
                <div class="p-6 text-gray-900 text-primary-content">
                    Selamat Datang, <strong>{{ auth()->user()->name }}!</strong>
                </div>
            </div>
            <div class="">
                <livewire:ann.menu />

                <livewire:ann.form />
            </div>
        </div>
    </div>
</div>
