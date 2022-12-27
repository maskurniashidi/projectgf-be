<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('parmissions', function (Blueprint $table) {
            $table->id();
            $table->integer('roleId');
            $table->boolean('canCreate');
            $table->boolean('canView');
            $table->boolean('canDelete');
            $table->boolean('canEdit');
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
        Schema::dropIfExists('parmissions');
    }
};
