@csrf
@if (isset($technologyField)) @method('PUT') @endif
<div>
    <x-label for="name" value="分野名" />
    <x-input id="name" class="mt-1 block w-full" type="text" name="name" :value="old('name', $technologyField->name ?? '')" placeholder="例：FRONTEND" required autofocus />
    <x-input-error for="name" class="mt-2" />
</div>
<div class="mt-8 flex items-center justify-end gap-3">
    <a class="rounded-md px-4 py-2 text-sm text-gray-600 hover:text-gray-900" href="{{ route('technology-fields.index') }}">キャンセル</a>
    <x-button>{{ isset($technologyField) ? '更新する' : '登録する' }}</x-button>
</div>
