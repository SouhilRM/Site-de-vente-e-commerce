<x-app-layout>

    <!-- ici c'est ton header -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hy Mister :  {{ Auth::user()->name }} <!-- tu applique le meddleware Auth pour voir si le user est connecter ou non puis tu recupere son nom depuis la BDD et tu l'affiche -->
        </h2>
    </x-slot>

    <!-- ici c'est ton body -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div>
    
</x-app-layout>
