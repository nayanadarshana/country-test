<?php

use App\Models\Client;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('calls', function (Blueprint $table) {
            $this->down();
            $table->id();
            $table->foreignIdFor(Client::class);
            $table->string('call_receiver', 255)->nullable();
            $table->string('called_number', 25)->nullable();
            $table->longText('notes')->nullable();
            $table->longText('response')->nullable();
            $table->string('communication_type')->nullable(); //
            //['call', 'email', 'visit to client', 'clients visit to our office']
            $table->enum('response_type', ['excellent', 'good',
                'average', 'call again', 'bad', 'rude'])->nullable();
            $table->longText('interests')->nullable();
            $table->boolean('call_again')->nullable();
            $table->dateTime('called_on')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calls');
    }
};
