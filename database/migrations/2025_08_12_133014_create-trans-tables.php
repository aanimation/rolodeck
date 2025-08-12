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
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('address');
            $table->string('address_number')->nullable();
            $table->string('postal_code')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('session')->unique('session_uniq');
            $table->foreignId('customer_id')->nullable()->index('customer_idx');
            $table->foreignId('user_id')->nullable()->index('user_idx');
            $table->decimal('total', 10, 2)->default(0);
            $table->decimal('tax_fee', 10, 2)->default(0);
            $table->set('status', ['paid', 'unpaid', 'cancelled', 'refunded'])->default('unpaid');
            $table->index('status');
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('order_id')->index('order_idx');
            $table->foreignId('product_id')->index('product_idx');
            $table->string('color')->nullable();
            $table->integer('unit');
            $table->decimal('price', 10, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('order_id')->index('order_idx');
            $table->foreignId('customer_id')->index('customer_idx');
            $table->string('payment_type')->nullable();
            $table->decimal('payment_amount', 10, 2)->nullable();
            $table->string('payment_status')->nullable();
            $table->longText('payment_url')->nullable();
            $table->longText('payment_note')->nullable();
            $table->timestamp('payment_datetime')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('carts');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('customers');
    }
};
