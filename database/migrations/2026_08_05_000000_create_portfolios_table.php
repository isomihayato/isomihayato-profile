<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('title', 120);
            $table->text('summary');
            $table->unsignedSmallInteger('year');
            $table->string('business_category', 80);
            $table->string('link_url', 2048)->nullable();
            $table->timestamps();
        });

        $now = now();

        DB::table('portfolios')->insert([
            ['title' => 'Webサービス開発・改善', 'summary' => 'Laravel / React　設計・実装・運用', 'year' => 2025, 'business_category' => '継続改善', 'link_url' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => '業務システム刷新', 'summary' => '要件整理からリリースまで一貫対応', 'year' => 2024, 'business_category' => '工数削減', 'link_url' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'テスト自動化基盤', 'summary' => 'Playwright E2E / CI連携', 'year' => 2024, 'business_category' => '品質向上', 'link_url' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'クラウド環境構築', 'summary' => 'AWS × Docker × CI/CD', 'year' => 2023, 'business_category' => '運用最適化', 'link_url' => null, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
