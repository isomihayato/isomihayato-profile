<!DOCTYPE html>
<html lang="ja">
<head><meta charset="utf-8"><title>{{ $inquiry->subject ?: 'お問い合わせについて' }}</title></head>
<body style="font-family: sans-serif; color: #222; line-height: 1.8;">
    <p>{{ $inquiry->name }} 様</p>
    <div>{!! nl2br(e($replyBody)) !!}</div>
    <hr style="margin: 32px 0; border: 0; border-top: 1px solid #ddd;">
    <p style="font-size: 12px; color: #666;">お問い合わせ内容</p>
    <div style="font-size: 13px; color: #555;">{!! nl2br(e($inquiry->message)) !!}</div>
</body>
</html>
