<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainNavsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_navs', function (Blueprint $table) {
            $table->id();
            $table->string('content_fa')->default('');
            $table->string('content_en')->default('');
            $table->string('content_ru')->default('');
            $table->string('content_fr')->default('');
            $table->string('url')->nullable();
            $table->string('route_name')->nullable();
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
        Schema::dropIfExists('main_navs');
    }
}
