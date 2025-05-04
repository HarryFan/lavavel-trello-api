<?php

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
        Schema::create('notification_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('browser_enabled')->default(true)->comment('是否啟用瀏覽器通知');
            $table->boolean('email_enabled')->default(true)->comment('是否啟用電子郵件通知');
            $table->integer('email_lead_time')->default(60)->comment('電子郵件提前通知時間（分鐘）');
            $table->integer('browser_lead_time')->default(30)->comment('瀏覽器提前通知時間（分鐘）');
            $table->dateTime('last_email_sent')->nullable()->comment('上次發送電子郵件的時間');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_settings');
    }
};
