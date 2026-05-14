<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id('order_id');

            // FK to users (students)
            $table->unsignedBigInteger('student_id');

            $table->dateTime('order_date');
            $table->string('order_status')->default('pending');
            $table->text('address');

            $table->timestamps();

            $table->foreign('student_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};