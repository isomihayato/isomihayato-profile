<x-app-layout>
    <x-slot name="header"><div class="flex items-center justify-between"><h2 class="text-xl font-semibold leading-tight text-gray-800">分野管理</h2><a class="rounded-md bg-gray-800 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700" href="{{ route('technology-fields.create') }}">新規登録</a></div></x-slot>
    <div class="py-12"><div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        @if (session('status')) <div class="mb-6 rounded-md bg-green-50 p-4 text-sm text-green-700">{{ session('status') }}</div> @endif
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
            @if ($technologyFields->isEmpty()) <div class="p-8 text-center text-gray-500">登録されている分野はありません。</div>
            @else <table class="min-w-full divide-y divide-gray-200"><thead class="bg-gray-50"><tr><th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">分野名</th><th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">経験技術数</th><th class="px-6 py-3 text-right text-xs font-medium uppercase text-gray-500">操作</th></tr></thead><tbody class="divide-y divide-gray-200">
                @foreach ($technologyFields as $technologyField)<tr><td class="px-6 py-4 font-medium text-gray-900">{{ $technologyField->name }}</td><td class="px-6 py-4 text-sm text-gray-600">{{ $technologyField->experienced_technologies_count }}件</td><td class="whitespace-nowrap px-6 py-4 text-right text-sm"><a class="mr-4 text-indigo-600 hover:text-indigo-900" href="{{ route('technology-fields.edit', $technologyField) }}">編集</a><form class="inline" action="{{ route('technology-fields.destroy', $technologyField) }}" method="POST" onsubmit="return confirm('分野を削除すると、配下の経験技術も削除されます。よろしいですか？')">@csrf @method('DELETE')<button class="text-red-600 hover:text-red-900" type="submit">削除</button></form></td></tr>@endforeach
            </tbody></table> @endif
        </div>
    </div></div>
</x-app-layout>
