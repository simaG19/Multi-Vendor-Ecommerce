<?php
// database/migrations/2025_11_19_000000_add_img_columns_to_products_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('img_1')->nullable()->after('description');
            $table->string('img_2')->nullable()->after('img_1');
            $table->string('img_3')->nullable()->after('img_2');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['img_1', 'img_2', 'img_3']);
        });
    }
};
