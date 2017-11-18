<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('send')->default(0);
            $table->dateTime('date_send')->nullable();
            $table->integer('client_id')->references('id')->on('clients');
            $table->integer('project_id')->default(0);
            $table->integer('number')->default(0);
            $table->string('prefix')->nullable();
            $table->integer('number_format')->default(0);
            $table->date('date');
            $table->date('deadline')->nullable();
            $table->integer('status')->default(1);
            $table->integer('currency_id')->references('id')->on('currencies');
            $table->decimal('subtotal');
            $table->decimal('total_tax')->default(0.00);
            $table->decimal('total');
            $table->decimal('adjustment')->nullable();
            $table->date('last_overdue_reminder')->nullable();
            $table->boolean('cancel_overdue_reminder')->default(false);
            $table->decimal('discount_percentage')->default(0.00);
            $table->decimal('discount_total')->default(0.00);
            $table->string('discount_type');
            $table->integer('recurring')->default(0);
            $table->string('recurring_type')->nullable();
            $table->boolean('custom_recurring')->nullable();
            $table->date('recurring_deadline')->nullable();
            $table->integer('is_recurring_from')->nullable();
            $table->date('last_recurring_date')->nullable();
            $table->integer('sales_agent')->references('id')->on('admin')->default(0);
            $table->boolean('include_shipping')->default(false);
            $table->boolean('show_shipping_adress_on_invoice')->default(false);
            $table->integer('show_quantity_as')->default(1);
            $table->text('terms')->nullable();
            $table->text('admin_note')->nullable();
            $table->text('client_note')->nullable();
            $table->mediumText('allowed_payment_types');
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
        Schema::dropIfExists('invoices');
    }
}
