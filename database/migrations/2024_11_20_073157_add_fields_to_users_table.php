<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('company_name')->nullable(); // Nullable company name
            $table->string('first_name')->nullable();   // Nullable first name
            $table->string('last_name')->nullable();    // Nullable last name
            $table->string('mobile_number')->nullable(); // Nullable mobile number
            $table->string('profile_photo')->nullable(); // Nullable profile photo URL
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['company_name', 'first_name', 'last_name', 'mobile_number', 'profile_photo']);
        });
    }

};
