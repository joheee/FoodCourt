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
        Schema::create('tenant_menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('tenant_menu_category_id')->constrained('tenant_menu_categorys');
            $table->string('tenant_menu_name');
            $table->string('tenant_menu_picture');
            $table->string('tenant_menu_description');
            $table->unsignedDouble('tenant_menu_price');
            $table->integer('tenant_menu_status');
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
        Schema::dropIfExists('tenant_menus');
    }
};
