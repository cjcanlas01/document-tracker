<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackedLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracked_logs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('document_id');
            /**
             * Table: status
             * 0: AVAILABLE
             * 1: RECEIVED
             * 2: RELEASED
             * 3: TERMINAL
             */
            $table->enum('status', [0, 1, 2, 3]);
            /**
             * Table: action
             * 0: APPROVED
             * 1: DISAPPROVED
             * 2: ENDORSE
             * 3: NO ACTION
             * 4: RECEIVED
             * 5: RETURN TO SENDER
             */
            $table->enum('action', [0, 1, 2, 3, 4, 5]);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('document_id')->references('id')->on('documents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tracked_logs');
    }
}
