<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('technology_fields', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80)->unique();
            $table->timestamps();
        });

        Schema::create('experienced_technologies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('technology_field_id')->constrained()->cascadeOnDelete();
            $table->string('name', 80);
            $table->timestamps();
            $table->unique(['technology_field_id', 'name']);
        });

        $now = now();
        $fields = [
            'FRONTEND' => ['React', 'TypeScript', 'Next.js', 'Vue.js', 'Sass / SCSS'],
            'BACKEND' => ['Laravel', 'Ruby on Rails', 'Node.js', 'PHP', 'Python'],
            'INFRA' => ['AWS', 'GCP', 'Docker', 'Kubernetes', 'Nginx'],
            'DB / TEST' => ['MySQL', 'PostgreSQL', 'Redis', 'Playwright', 'Jest'],
        ];

        foreach ($fields as $fieldName => $technologies) {
            $fieldId = DB::table('technology_fields')->insertGetId([
                'name' => $fieldName,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            DB::table('experienced_technologies')->insert(array_map(fn (string $technology): array => [
                'technology_field_id' => $fieldId,
                'name' => $technology,
                'created_at' => $now,
                'updated_at' => $now,
            ], $technologies));
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('experienced_technologies');
        Schema::dropIfExists('technology_fields');
    }
};
