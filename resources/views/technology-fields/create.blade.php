<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold leading-tight text-gray-800">分野登録</h2></x-slot>
    <div class="py-12"><div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8"><div class="bg-white p-6 shadow-xl sm:rounded-lg"><form action="{{ route('technology-fields.store') }}" method="POST">@include('technology-fields._form')</form></div></div></div>
</x-app-layout>
