<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between"><h2 class="text-xl font-semibold leading-tight text-gray-800">お問い合わせ詳細</h2><a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('contact-inquiries.index') }}">一覧へ戻る</a></div>
    </x-slot>

    <div class="py-12"><div class="mx-auto max-w-6xl space-y-6 px-4 sm:px-6 lg:px-8">
        @if (session('status')) <div class="rounded-md bg-green-50 p-4 text-sm text-green-700">{{ session('status') }}</div> @endif

        <section class="bg-white p-6 shadow-xl sm:rounded-lg">
            <div class="mb-6 flex items-center justify-between"><h3 class="text-lg font-semibold text-gray-900">メール履歴</h3><span class="rounded-full px-2 py-1 text-xs {{ $contactInquiry->status === 'replied' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-800' }}">{{ $contactInquiry->status === 'replied' ? '返信済み' : '未返信' }}</span></div>

            <div class="space-y-6">
                <article class="mr-8 rounded-lg border border-gray-200 bg-gray-50 p-5">
                    <header class="mb-4 flex flex-wrap items-start justify-between gap-2"><div><span class="rounded bg-blue-100 px-2 py-1 text-xs font-medium text-blue-700">受信</span><p class="mt-2 font-semibold text-gray-900">{{ $contactInquiry->subject ?: '（件名なし）' }}</p></div><time class="text-xs text-gray-500">{{ $contactInquiry->created_at->format('Y/m/d H:i') }}</time></header>
                    <p class="text-sm text-gray-500">From: {{ $contactInquiry->name }} &lt;{{ $contactInquiry->email }}&gt;</p>
                    <p class="mt-4 whitespace-pre-wrap text-sm leading-7 text-gray-900">{{ $contactInquiry->message }}</p>
                </article>

                @foreach ($contactInquiry->replies as $reply)
                    <article class="ml-8 rounded-lg border border-green-200 bg-green-50 p-5">
                        <header class="mb-4 flex flex-wrap items-start justify-between gap-2"><div><span class="rounded bg-green-100 px-2 py-1 text-xs font-medium text-green-700">返信 {{ $loop->iteration }}</span><p class="mt-2 font-semibold text-gray-900">{{ $reply->subject }}</p></div><time class="text-xs text-gray-500">{{ $reply->sent_at->format('Y/m/d H:i') }}</time></header>
                        <p class="text-sm text-gray-500">From: {{ $reply->sender?->name ?? '管理者' }} / To: {{ $contactInquiry->email }}</p>
                        <p class="mt-4 whitespace-pre-wrap text-sm leading-7 text-gray-900">{{ $reply->body }}</p>
                    </article>
                @endforeach
            </div>
        </section>

        <section class="bg-white p-6 shadow-xl sm:rounded-lg">
            <h3 class="text-lg font-semibold text-gray-900">{{ $contactInquiry->replies->isNotEmpty() ? '追加返信する' : '返信する' }}</h3>
            <form class="mt-6 space-y-6" action="{{ route('contact-inquiries.reply', $contactInquiry) }}" method="POST">@csrf
                <div>
                    <x-label for="reply_subject" value="返信メールの件名" />
                    <x-input id="reply_subject" class="mt-1 block w-full" type="text" name="reply_subject" :value="old('reply_subject', 'Re: '.($contactInquiry->subject ?: 'お問い合わせについて'))" required />
                    <x-input-error for="reply_subject" class="mt-2" />
                </div>
                <div>
                    <x-label for="reply_body" value="返信内容" />
                    <textarea id="reply_body" class="mt-1 block min-h-64 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" name="reply_body" required>{{ old('reply_body') }}</textarea>
                    <x-input-error for="reply_body" class="mt-2" />
                </div>
                <div class="flex items-center justify-between"><p class="text-xs text-gray-500">宛先：{{ $contactInquiry->email }}</p><x-button>返信メールを送信</x-button></div>
            </form>
        </section>

        <form action="{{ route('contact-inquiries.destroy', $contactInquiry) }}" method="POST" onsubmit="return confirm('このお問い合わせと返信履歴を削除しますか？')">@csrf @method('DELETE')<button class="text-sm text-red-600 hover:text-red-900" type="submit">お問い合わせと履歴を削除</button></form>
    </div></div>
</x-app-layout>
