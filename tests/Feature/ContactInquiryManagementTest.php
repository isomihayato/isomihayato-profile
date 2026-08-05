<?php

namespace Tests\Feature;

use App\Mail\ContactInquiryReply;
use App\Models\ContactInquiry;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactInquiryManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_saves_inquiry(): void
    {
        $response = $this->post(route('contact.store'), $this->inquiryData());

        $response->assertRedirect(route('home').'#contact')->assertSessionHas('contact_status');
        $this->assertDatabaseHas('contact_inquiries', [
            'name' => '山田 太郎',
            'email' => 'taro@example.com',
            'subject' => '開発の相談',
            'status' => 'unread',
        ]);
    }

    public function test_contact_form_fields_are_validated(): void
    {
        $this->post(route('contact.store'), [
            'name' => '',
            'email' => 'invalid',
            'message' => '',
        ])->assertSessionHasErrors(['name', 'email', 'message']);
    }

    public function test_guest_cannot_access_inquiry_management(): void
    {
        $inquiry = ContactInquiry::create($this->inquiryData());

        $this->get(route('contact-inquiries.index'))->assertRedirect(route('login'));
        $this->get(route('contact-inquiries.show', $inquiry))->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_view_inquiry(): void
    {
        $user = User::factory()->create();
        $inquiry = ContactInquiry::create($this->inquiryData());

        $this->actingAs($user)->get(route('contact-inquiries.show', $inquiry))
            ->assertOk()
            ->assertSee('山田 太郎')
            ->assertSee('taro@example.com')
            ->assertSee('Webアプリ開発について相談したいです。');
    }

    public function test_authenticated_user_can_reply_to_inquiry(): void
    {
        Mail::fake();
        $user = User::factory()->create();
        $inquiry = ContactInquiry::create($this->inquiryData());

        $this->actingAs($user)->post(route('contact-inquiries.reply', $inquiry), [
            'reply_subject' => 'Re: 開発の相談',
            'reply_body' => 'お問い合わせありがとうございます。対応可能です。',
        ])->assertRedirect(route('contact-inquiries.show', $inquiry));

        Mail::assertSent(ContactInquiryReply::class, function (ContactInquiryReply $mail) use ($inquiry): bool {
            return $mail->hasTo($inquiry->email)
                && $mail->replySubject === 'Re: 開発の相談'
                && $mail->replyBody === 'お問い合わせありがとうございます。対応可能です。';
        });
        $this->assertDatabaseHas('contact_replies', [
            'contact_inquiry_id' => $inquiry->id,
            'subject' => 'Re: 開発の相談',
            'body' => 'お問い合わせありがとうございます。対応可能です。',
            'sent_by' => $user->id,
        ]);
        $this->assertDatabaseHas('contact_inquiries', [
            'id' => $inquiry->id,
            'status' => 'replied',
            'reply_body' => 'お問い合わせありがとうございます。対応可能です。',
            'replied_by' => $user->id,
        ]);
        $this->assertNotNull($inquiry->fresh()->replied_at);
    }

    public function test_multiple_replies_are_displayed_as_mail_history(): void
    {
        Mail::fake();
        $user = User::factory()->create();
        $inquiry = ContactInquiry::create($this->inquiryData());

        foreach ([
            ['Re: 開発の相談', '最初の返信です。'],
            ['Re: 開発の相談（追記）', '追加の返信です。'],
        ] as [$subject, $body]) {
            $this->actingAs($user)->post(route('contact-inquiries.reply', $inquiry), [
                'reply_subject' => $subject,
                'reply_body' => $body,
            ])->assertRedirect(route('contact-inquiries.show', $inquiry));
        }

        $this->actingAs($user)->get(route('contact-inquiries.show', $inquiry))
            ->assertOk()
            ->assertSee('開発の相談')
            ->assertSee('Webアプリ開発について相談したいです。')
            ->assertSee('Re: 開発の相談')
            ->assertSee('最初の返信です。')
            ->assertSee('Re: 開発の相談（追記）')
            ->assertSee('追加の返信です。');

        $this->assertCount(2, $inquiry->replies()->get());
    }

    public function test_reply_subject_and_body_are_required(): void
    {
        Mail::fake();
        $user = User::factory()->create();
        $inquiry = ContactInquiry::create($this->inquiryData());

        $this->actingAs($user)->post(route('contact-inquiries.reply', $inquiry), [
            'reply_subject' => '',
            'reply_body' => '',
        ])->assertSessionHasErrors(['reply_subject', 'reply_body']);

        Mail::assertNothingSent();
    }

    public function test_authenticated_user_can_delete_inquiry(): void
    {
        $user = User::factory()->create();
        $inquiry = ContactInquiry::create($this->inquiryData());

        $this->actingAs($user)->delete(route('contact-inquiries.destroy', $inquiry))
            ->assertRedirect(route('contact-inquiries.index'));

        $this->assertDatabaseMissing('contact_inquiries', ['id' => $inquiry->id]);
    }

    /** @return array<string, string> */
    private function inquiryData(): array
    {
        return [
            'name' => '山田 太郎',
            'email' => 'taro@example.com',
            'subject' => '開発の相談',
            'message' => 'Webアプリ開発について相談したいです。',
        ];
    }
}
