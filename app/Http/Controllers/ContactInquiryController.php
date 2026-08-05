<?php

namespace App\Http\Controllers;

use App\Mail\ContactInquiryReply;
use App\Models\ContactInquiry;
use App\Models\ContactReply;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactInquiryController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->string('status')->toString();

        return view('contact-inquiries.index', [
            'inquiries' => ContactInquiry::query()
                ->when(in_array($status, ['unread', 'replied'], true), fn ($query) => $query->where('status', $status))
                ->latest()
                ->paginate(20)
                ->withQueryString(),
            'status' => $status,
        ]);
    }

    public function show(ContactInquiry $contactInquiry): View
    {
        $contactInquiry->load(['replier', 'replies.sender']);

        return view('contact-inquiries.show', compact('contactInquiry'));
    }

    public function reply(Request $request, ContactInquiry $contactInquiry): RedirectResponse
    {
        $validated = $request->validate([
            'reply_subject' => ['required', 'string', 'max:200'],
            'reply_body' => ['required', 'string', 'max:5000'],
        ]);

        Mail::to($contactInquiry->email)->send(new ContactInquiryReply(
            $contactInquiry,
            $validated['reply_subject'],
            $validated['reply_body'],
        ));

        $sentAt = now();

        ContactReply::create([
            'contact_inquiry_id' => $contactInquiry->id,
            'subject' => $validated['reply_subject'],
            'body' => $validated['reply_body'],
            'sent_by' => $request->user()->id,
            'sent_at' => $sentAt,
        ]);

        $contactInquiry->update([
            'status' => 'replied',
            'reply_body' => $validated['reply_body'],
            'replied_at' => $sentAt,
            'replied_by' => $request->user()->id,
        ]);

        return to_route('contact-inquiries.show', $contactInquiry)->with('status', '返信メールを送信しました。');
    }

    public function destroy(ContactInquiry $contactInquiry): RedirectResponse
    {
        $contactInquiry->delete();

        return to_route('contact-inquiries.index')->with('status', 'お問い合わせを削除しました。');
    }
}
