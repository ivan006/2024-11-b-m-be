<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('recipient_id'); // References the ID of the recipient user
            $table->text('email_body'); // Stores the email body
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('recipient_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('mails');
    }

};
