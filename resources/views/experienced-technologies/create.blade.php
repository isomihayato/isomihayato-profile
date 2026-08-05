<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold leading-tight text-gray-800">経験技術登録</h2></x-slot>
    <div class="py-12"><div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8"><div class="bg-white p-6 shadow-xl sm:rounded-lg">
        @if ($technologyFields->isEmpty()) <div class="rounded-md bg-yellow-50 p-4 text-sm text-yellow-800">先に分野を登録してください。<a class="underline" href="{{ route('technology-fields.create') }}">分野を登録する</a></div>
        @else <form action="{{ route('experienced-technologies.store') }}" method="POST">@include('experienced-technologies._form')</form> @endif
    </div></div></div>
</x-app-layout>
