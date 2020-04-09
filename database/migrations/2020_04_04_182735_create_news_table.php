<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')
                ->nullable(false)
                ->comment('Заголовок новости');
            $table->text('body')
                ->nullable(false)
                ->comment('Тело новости');
            $table->boolean('isPrivate')
                ->default(false)
                ->comment('Флаг приватности');
            $table->string('image')
                ->nullable(true)
                ->default(null)
                ->comment('Название картинки');
            $table->unsignedBigInteger('category_id')->comment('ID Категории');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
