<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id'); // поле с автоинкриментом, название поля id
            $table->string('name',100); // поле varchar
            $table->string('alias',100);
            $table->text('text'); // поле текст
            $table->string('images',100);
            $table->timestamps(); // создает 2 поля время создания и время изменения таблицы
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
