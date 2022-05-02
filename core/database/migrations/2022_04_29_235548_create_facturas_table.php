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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->string('nitVendedor', 10)->nullable();
            $table->string('nombreVendedor')->nullable();
            $table->string('nitComprador', 10)->nullable();
            $table->string('nombreComprador')->nullable();
            $table->decimal('price', 9, 3)->nullable();
            $table->float('iva', 8, 2)->nullable();
            $table->decimal('total', 9, 3)->nullable();
            $table->char('estado', 1);

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
        Schema::dropIfExists('facturas');
    }
};
