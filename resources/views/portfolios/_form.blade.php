@csrf
@if (isset($portfolio))
    @method('PUT')
@endif

<div class="grid grid-cols-1 gap-6">
    <div>
        <x-label for="title" value="タイトル" />
        <x-input id="title" class="mt-1 block w-full" type="text" name="title" :value="old('title', $portfolio->title ?? '')" required autofocus />
        <x-input-error for="title" class="mt-2" />
    </div>

    <div>
        <x-label for="summary" value="概要" />
        <textarea id="summary" class="mt-1 block min-h-32 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" name="summary" required>{{ old('summary', $portfolio->summary ?? '') }}</textarea>
        <x-input-error for="summary" class="mt-2" />
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <div>
            <x-label for="year" value="対応年" />
            <x-input id="year" class="mt-1 block w-full" type="number" name="year" min="1900" max="2100" :value="old('year', $portfolio->year ?? now()->year)" required />
            <x-input-error for="year" class="mt-2" />
        </div>

        <div>
            <x-label for="business_category" value="業務内容区分" />
            <x-input id="business_category" class="mt-1 block w-full" type="text" name="business_category" :value="old('business_category', $portfolio->business_category ?? '')" placeholder="例：Webアプリ開発" required />
            <x-input-error for="business_category" class="mt-2" />
        </div>
    </div>

    <div>
        <x-label for="link_url" value="リンクURL（任意）" />
        <x-input id="link_url" class="mt-1 block w-full" type="url" name="link_url" :value="old('link_url', $portfolio->link_url ?? '')" placeholder="https://example.com" />
        <x-input-error for="link_url" class="mt-2" />
    </div>
</div>

<div class="mt-8 flex items-center justify-end gap-3">
    <a class="rounded-md px-4 py-2 text-sm text-gray-600 hover:text-gray-900" href="{{ route('portfolios.index') }}">キャンセル</a>
    <x-button>{{ isset($portfolio) ? '更新する' : '登録する' }}</x-button>
</div>
