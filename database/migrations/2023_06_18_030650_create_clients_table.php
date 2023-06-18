<?php

use App\Models\City;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(City::class);
            $table->string('company', 255);
            $table->string('street', 255)->nullable();
            $table->string('zipcode', 15)->nullable();
            $table->string('phone1', 20)->nullable();
            $table->string('phone2', 20)->nullable();
            $table->string('mobile1', 20)->nullable();
            $table->string('mobile2', 20)->nullable();
            $table->string('whatsapp', 20)->nullable();
            $table->string('email1', 255)->nullable();
            $table->string('email2', 255)->nullable();
            $table->string('web', 255)->nullable();
            $table->longText('notes')->nullable();
            $table->longText('admin_notes')->nullable();
            $table->boolean('active')->default(1);
            $table->boolean('blocked_by_admin')->default(0);
            $table->integer('blocked_by_admin_id')->nullable();
            $table->boolean('unsubscribed')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
