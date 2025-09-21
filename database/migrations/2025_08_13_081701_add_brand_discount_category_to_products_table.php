<?php
// database/migrations/xxxx_xx_xx_add_brand_discount_category_to_products_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('products', function (Blueprint $table) {
            $table->string('brand')->nullable()->after('name');
            $table->unsignedInteger('discount_percent')->default(0)->after('price'); // 0-100
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
        });
    }
    public function down(): void {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['brand', 'discount_percent']);
            $table->dropConstrainedForeignId('category_id');
        });
    }
};
