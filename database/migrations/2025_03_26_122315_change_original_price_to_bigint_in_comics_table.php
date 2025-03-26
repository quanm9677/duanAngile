<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeOriginalPriceToBigintInComicsTable extends Migration
{
    public function up()
    {
        Schema::table('comics', function (Blueprint $table) {
            $table->bigInteger('original_price')->change(); // Thay đổi kiểu dữ liệu thành BIGINT
        });
    }

    public function down()
    {
        Schema::table('comics', function (Blueprint $table) {
            $table->decimal('original_price', 10, 2)->change(); // Quay lại kiểu dữ liệu cũ
        });
    }
}