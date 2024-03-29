<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {

            $table->id();

            $table->string('website')->nullable();
            $table->string('logo_url')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('slug')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('business_name')->nullable();
            $table->string('business_branch')->nullable();
            $table->string('address')->nullable();
            $table->string('line_two')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country_code')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('phone')->nullable();
            $table->string('extension')->nullable();
            $table->string('fax')->nullable();
            $table->string('vat_number')->nullable();
            $table->text('notes')->nullable();
            $table->string('type')->nullable();
            $table->string('business_type')->nullable();
            $table->string('directory')->nullable();
            $table->string('referred_by')->nullable();
            $table->string('use_accounts')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('send_newsletter')->default(false);
            $table->foreignUuid('user_uuid')->nullable();
            $table->foreignUuid('team_uuid')->nullable();

            $table->timestamps();

        });
    }
};
