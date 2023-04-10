<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contact_lists_contacts', function (Blueprint $table) {

            $table->integer('contact_id')->unsigned();

            $table->integer('contact_list_id')->unsigned();

            $table->foreign('contact_id')->references('id')->on('contacts')
                ->onDelete('cascade');

            $table->foreign('contact_list_id')->references('id')->on('contact_lists')
                ->onDelete('cascade');

        });
    }
};
