<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supports', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('employee_id');
            $table->string('type')->comment('mail type');
            $table->string('subject')->comment('mail subject')->nullable();
            $table->string('body')->comment('mail body')->nullable();
            $table->string('priority')->comment('mail priority')->nullable();
            $table->string('status')->comment('mail status')->nullable();
            $table->string('expired')->comment('mail expired')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supports');
    }
}
