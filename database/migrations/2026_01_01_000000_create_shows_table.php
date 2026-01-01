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
        Schema::create('shows', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('country');
            $table->string('city');
            $table->string('venue');
            $table->string('venue_address')->nullable();

            $table->date('date');
            $table->time('start_time')->nullable();

            $table->text('description')->nullable();
            $table->string('poster_image')->nullable();

            $table->enum('status', ['upcoming', 'sold_out', 'cancelled', 'past'])->default('upcoming');

            $table->decimal('base_price', 8, 2)->nullable();
            $table->string('currency', 3)->default('GTQ');
            $table->boolean('is_free')->default(false);

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
        Schema::dropIfExists('shows');
    }
};
