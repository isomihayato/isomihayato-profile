<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_inquiry_id')->constrained()->cascadeOnDelete();
            $table->string('subject', 200);
            $table->text('body');
            $table->foreignId('sent_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('sent_at');
            $table->timestamps();
        });

        DB::table('contact_inquiries')
            ->whereNotNull('reply_body')
            ->orderBy('id')
            ->each(function (object $inquiry): void {
                DB::table('contact_replies')->insert([
                    'contact_inquiry_id' => $inquiry->id,
                    'subject' => 'Re: '.($inquiry->subject ?: 'お問い合わせについて'),
                    'body' => $inquiry->reply_body,
                    'sent_by' => $inquiry->replied_by,
                    'sent_at' => $inquiry->replied_at ?: $inquiry->updated_at,
                    'created_at' => $inquiry->replied_at ?: $inquiry->updated_at,
                    'updated_at' => $inquiry->replied_at ?: $inquiry->updated_at,
                ]);
            });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_replies');
    }
};
