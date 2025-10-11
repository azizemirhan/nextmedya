<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_service_id_to_menu_items_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->unsignedBigInteger('service_id')->nullable()->after('page_id');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropColumn('service_id');
        });
    }
};
