<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterNewsAddImgUriAndPublishedAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function(Blueprint $table) {
            $table->string('img_uri')
                ->nullable(true)
                ->comment('Внешняя картинка');
            $table->dateTimeTz('published_at')
                ->nullable(true)
                ->comment('Дата публикации (внешняя дата)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function(Blueprint $table) {
            $table->dropColumn('img_uri');
            $table->dropColumn('published_at');
        });
    }
}
