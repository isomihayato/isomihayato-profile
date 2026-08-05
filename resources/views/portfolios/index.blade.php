<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">ポートフォリオ管理</h2>
            <a class="rounded-md bg-gray-800 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700" href="{{ route('portfolios.create') }}">新規登録</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-6 rounded-md bg-green-50 p-4 text-sm text-green-700">{{ session('status') }}</div>
            @endif

            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                @if ($portfolios->isEmpty())
                    <div class="p-8 text-center text-gray-500">登録されているポートフォリオはありません。</div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr><th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">タイトル・概要</th><th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">対応年</th><th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">業務内容区分</th><th class="px-6 py-3 text-right text-xs font-medium uppercase text-gray-500">操作</th></tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($portfolios as $portfolio)
                                    <tr>
                                        <td class="px-6 py-4"><div class="font-medium text-gray-900">{{ $portfolio->title }}</div><div class="mt-1 max-w-xl text-sm text-gray-500">{{ $portfolio->summary }}</div>@if ($portfolio->link_url)<a class="mt-1 inline-block text-xs text-indigo-600 hover:underline" href="{{ $portfolio->link_url }}" target="_blank" rel="noopener noreferrer">リンクを確認</a>@endif</td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $portfolio->year }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $portfolio->business_category }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 text-right text-sm"><a class="mr-4 text-indigo-600 hover:text-indigo-900" href="{{ route('portfolios.edit', $portfolio) }}">編集</a><form class="inline" action="{{ route('portfolios.destroy', $portfolio) }}" method="POST" onsubmit="return confirm('このポートフォリオを削除しますか？')">@csrf @method('DELETE')<button class="text-red-600 hover:text-red-900" type="submit">削除</button></form></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
