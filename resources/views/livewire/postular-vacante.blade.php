<div class="bg-gray-100 p-5 mt-10 flex justify-center flex-col items-center">
    <h3 class="text-center text-2xl font-bold my-4">Postularme a esta vacante</h3>

    @if (session()->has('mensaje'))
        <div class="uppercase border border-green-600 bg-green-100 text-green-600 font-bold p-2 my-5 rounded-lg">
            {{session('mensaje')}}
        </div>
    @else

    <form 
    wire:submit.prevent='postularme'
    class="w-96 mt-5">
        <div class="mb-4">
            <x-input-label 
            for="cv" 
            :value="__('CV en formato PDF')"
            
            ></x-input-label>
            <x-text-input 
            wire:model="cv"
            id="cv" 
            type="file" 
            accept=".pdf" 
            class="block mt-1 w-full"></x-text-input>
        </div>

        <x-input-error :messages="$errors->get('cv')" class="mt-2" />


        <x-primary-button class="my-5">{{__('Postularme')}}</x-primary-butt>
    </form>


    @endif

</div>
