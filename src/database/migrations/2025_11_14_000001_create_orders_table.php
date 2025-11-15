<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id')->nullable();
                $table->string('email')->nullable();
                $table->string('shipping_address');
                $table->string('status')->default('pending');
                $table->decimal('total', 10, 2);
                $table->timestamps();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            });
        }
    }
    public function down() {
        Schema::dropIfExists('orders');
    }
};

