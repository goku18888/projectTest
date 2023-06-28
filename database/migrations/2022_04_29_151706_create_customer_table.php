<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_customer');
            $table->string('pass_word');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('img_customer');
            $table->string('token');
            $table->tinyInteger('is_verified')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->rememberToken();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer');
    }
};
