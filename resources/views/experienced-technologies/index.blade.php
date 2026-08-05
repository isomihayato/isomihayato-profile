<x-app-layout>
    <x-slot name="header"><div class="flex items-center justify-between"><h2 class="text-xl font-semibold leading-tight text-gray-800">経験技術管理</h2><a class="rounded-md bg-gray-800 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700" href="{{ route('experienced-technologies.create') }}">新規登録</a></div></x-slot>
    <div class="py-12"><div class="mx-auto max-w-6xl space-y-6 px-4 sm:px-6 lg:px-8">
        @if (session('status')) <div class="rounded-md bg-green-50 p-4 text-sm text-green-700">{{ session('status') }}</div> @endif
        @forelse ($technologyFields as $technologyField)
            <section class="overflow-hidden bg-white shadow-xl sm:rounded-lg"><header class="flex items-center justify-between bg-gray-50 px-6 py-4"><h3 class="font-semibold text-gray-900">{{ $technologyField->name }}</h3><span class="text-sm text-gray-500">{{ $technologyField->experiencedTechnologies->count() }}件</span></header>
                @if ($technologyField->experiencedTechnologies->isEmpty()) <p class="p-6 text-sm text-gray-500">経験技術は未登録です。</p>
                @else <ul class="divide-y divide-gray-200">@foreach ($technologyField->experiencedTechnologies as $experiencedTechnology)<li class="flex items-center justify-between px-6 py-4"><span class="text-gray-900">{{ $experiencedTechnology->name }}</span><div class="text-sm"><a class="mr-4 text-indigo-600 hover:text-indigo-900" href="{{ route('experienced-technologies.edit', $experiencedTechnology) }}">編集</a><form class="inline" action="{{ route('experienced-technologies.destroy', $experiencedTechnology) }}" method="POST" onsubmit="return confirm('この経験技術を削除しますか？')">@csrf @method('DELETE')<button class="text-red-600 hover:text-red-900" type="submit">削除</button></form></div></li>@endforeach</ul> @endif
            </section>
        @empty <div class="rounded-md bg-white p-8 text-center text-gray-500 shadow-xl">分野が登録されていません。<a class="text-indigo-600 underline" href="{{ route('technology-fields.create') }}">分野を登録する</a></div> @endforelse
    </div></div>
</x-app-layout>
