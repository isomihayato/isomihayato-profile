@csrf
@if (isset($experiencedTechnology)) @method('PUT') @endif
<div class="grid grid-cols-1 gap-6">
    <div>
        <x-label for="technology_field_id" value="分野" />
        <select id="technology_field_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" name="technology_field_id" required>
            <option value="">選択してください</option>
            @foreach ($technologyFields as $technologyField)<option value="{{ $technologyField->id }}" @selected((string) old('technology_field_id', $experiencedTechnology->technology_field_id ?? '') === (string) $technologyField->id)>{{ $technologyField->name }}</option>@endforeach
        </select>
        <x-input-error for="technology_field_id" class="mt-2" />
    </div>
    <div>
        <x-label for="name" value="経験技術名" />
        <x-input id="name" class="mt-1 block w-full" type="text" name="name" :value="old('name', $experiencedTechnology->name ?? '')" placeholder="例：Laravel" required />
        <x-input-error for="name" class="mt-2" />
    </div>
</div>
<div class="mt-8 flex items-center justify-end gap-3"><a class="rounded-md px-4 py-2 text-sm text-gray-600 hover:text-gray-900" href="{{ route('experienced-technologies.index') }}">キャンセル</a><x-button>{{ isset($experiencedTechnology) ? '更新する' : '登録する' }}</x-button></div>
