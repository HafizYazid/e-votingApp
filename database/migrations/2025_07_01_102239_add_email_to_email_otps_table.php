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
    Schema::table('email_otps', function (Illuminate\Database\Schema\Blueprint $table) {
        $table->string('email')->after('id_user')->nullable();
    });
}

public function down()
{
    Schema::table('email_otps', function (Illuminate\Database\Schema\Blueprint $table) {
        $table->dropColumn('email');
    });
}

};
