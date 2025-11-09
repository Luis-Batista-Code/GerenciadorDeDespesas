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
    public function up(): void
{
    Schema::create('despesas', function (Blueprint $table) {
        $table->id();
        $table->string('descricao');
        $table->decimal('valor', 10, 2); 
        $table->date('data');

        $table->foreignId('categoria_id')->constrained('categorias');

        $table->foreignId('user_id')->constrained('users');

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
        Schema::dropIfExists('despesas');
    }
};
