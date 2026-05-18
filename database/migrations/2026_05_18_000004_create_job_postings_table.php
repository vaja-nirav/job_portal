<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('thumbnail')->nullable();
            $table->longText('description')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->json('Important_Link')->nullable();
            $table->json('overviews')->nullable();
            $table->json('Important_Dates')->nullable();
            $table->json('Vacancy_Details')->nullable();
            $table->longText('Eligibility_Criteria')->nullable();
            $table->longText('How_to_Apply')->nullable();
            $table->json('FAQs')->nullable();
            $table->string('status')->default('published'); // draft, published, expired
            $table->unsignedBigInteger('views_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
