<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTechniciansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets_technicians', function (Blueprint $table) {
            $table->unsignedBigInteger('id_ticket');
            $table->foreign('id_ticket')->references('id')->on('tickets');
            $table->unsignedBigInteger('id_technician');
            $table->foreign('id_technician')->references('id')->on('technicians');
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
        Schema::dropIfExists('tickets_technicians');
    }
}
