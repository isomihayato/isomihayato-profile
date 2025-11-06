<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->default(null)->comment('名前');
            $table->string('nickname')->comment('ニックネーム');
            $table->unsignedSmallInteger('status')->index()->default(1)->comment('ステータス');
            $table->text('properties')->nullable()->default(null)->comment('属性');
            $table->string('login_id')->index()->nullable()->default(null)->comment('ログインID');
            $table->string('email')->index()->nullable()->default(null)->comment('メールアドレス');
            $table->datetime('birthday')->nullable()->default(null)->comment('誕生日');
            $table->string('tel')->nullable()->default(null)->comment('電話番号');
            $table->string('icon')->nullable()->default(null)->comment('ユーザーアイコン');
            $table->text('visited_shop_ids')->nullable()->default(null)->comment('アクセス可店舗ID');
            $table->unsignedBigInteger('visiting_shop_id')->index()->nullable()->default(null)->comment('来店中店舗ID');
            $table->string('visiting_shop_name')->nullable()->default(null)->comment('来店中店舗名');
            $table->unsignedBigInteger('latest_visit_id')->index()->nullable()->default(null)->comment('最終来店モデルID');
            $table->datetime('latest_visited_date')->nullable()->default(null)->comment('最終来店日');
            $table->datetime('latest_visited_at')->nullable()->default(null)->comment('最終来店日時');
            $table->unsignedBigInteger('total_chip')->default(0)->comment('合計チップ数');
            $table->unsignedBigInteger('total_mile')->default(0)->comment('合計マイル数');
            $table->unsignedBigInteger('total_visit')->default(0)->comment('合計来店回数');
            $table->unsignedBigInteger('total_minutes')->default(0)->comment('合計来店分数');
            $table->unsignedBigInteger('total_amount')->default(0)->comment('合計支払額');
            $table->text('note')->nullable()->default(null)->comment('メモ');
            $table->timestamp('email_verified_at')->nullable()->default(null)->comment('メール確認期限');
            $table->string('password')->comment('パスワード');
            $table->rememberToken()->comment('パスワード記録トークン');
            $table->text('token')->nullable()->default(null)->comment('トークン');
            $table->text('qr_token')->nullable()->default(null)->comment('QRコードトークン');
            $table->datetime('latest_login_at')->nullable()->default(null)->comment('最終ログイン日時');
            $table->unsignedBigInteger('transferred_customer_id')->index()->nullable()->default(null)->comment('移行会員ID');
            $table->datetime('transferred_at')->nullable()->default(null)->comment('会員移行日時');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `customers` CHANGE `name` `name` VARCHAR(255) BINARY CHARACTER SET utf8mb4 NULL DEFAULT NULL COMMENT '名前';");
        DB::statement("ALTER TABLE `customers` CHANGE `nickname` `nickname` VARCHAR(255) BINARY CHARACTER SET utf8mb4 NULL DEFAULT NULL COMMENT 'ニックネーム';");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
