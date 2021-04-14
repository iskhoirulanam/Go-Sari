<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nik', 20)->after('password');
            $table->string('phone', 20)->after('nik');
            $table->unsignedBigInteger('garbage_category_id');
            $table->string('garbage_can_location', 20)->after('garbage_category_id');
            $table->string('garbage_can_picture', 20)->after('garbage_can_location')->nullable();
            $table->unsignedBigInteger('hamlet_id')->after('garbage_can_picture');
            $table->string('rt', 2)->after('hamlet_id');
            $table->text('address', 2)->after('rt');
            $table->string('status', 10)->after('address');
            $table->string('profile_picture')->after('status')->nullable();

            $table->foreign('garbage_category_id')->references('id')->on('garbage_categories');
            $table->foreign('hamlet_id')->references('id')->on('hamlets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
