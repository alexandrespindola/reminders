<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('reminders', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description')->nullable();
        $table->dateTime('reminder_time');
        $table->enum('status', ['pending', 'sent', 'cancelled'])->default('pending');
        $table->enum('notification_type', ['email', 'whatsapp', 'both'])->default('email');
        $table->string('email_recipient');
        $table->string('whatsapp_recipient');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};
