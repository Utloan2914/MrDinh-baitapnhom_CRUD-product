<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('gender', 10);
            $table->string('email', 50)->unique();
            $table->string('address', 100);
            $table->string('phone_number', 20);
            $table->text('note')->nullable();
            $table->timestamps();
        });

        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_customer')->nullable();
            $table->foreign('id_customer')->references('id')->on('customers')->onDelete('cascade');
            $table->date('date_order');
            $table->double('total');
            $table->string('payment', 200);
            $table->text('note')->nullable();
            $table->timestamps();
        });

        Schema::create('type_products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description');
            $table->string('image', 255)->nullable();
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->unsignedBigInteger('id_type');
            $table->text('description');
            $table->float('unit_price');
            $table->float('promotion_price')->nullable();
            $table->string('image', 255)->nullable();
            $table->string('unit', 255);
            $table->timestamps();
        });

        Schema::create('bill_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_bill')->constrained('bills')->onDelete('cascade');
            $table->foreignId('id_product')->constrained('products')->onDelete('cascade');
            $table->integer('quantity');
            $table->double('unit_price');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->text('content');
            $table->string('image', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->string('link', 100);
            $table->string('image', 100);
            $table->timestamps();
        });
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->text('comment');
            $table->unsignedBigInteger('id_product');
            $table->timestamps();
            $table->foreign('id_product')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_details');
        Schema::dropIfExists('bills');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('products');
        Schema::dropIfExists('type_products');
        Schema::dropIfExists('users');
        Schema::dropIfExists('news');
        Schema::dropIfExists('slides');
        Schema::dropIfExists('comments');
    }
};
