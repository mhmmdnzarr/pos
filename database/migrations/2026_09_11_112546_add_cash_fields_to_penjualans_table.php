<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::table('penjualan', function (Blueprint $table) {
        $table->decimal('cash_amount', 12, 2)->nullable()->after('total_pembayaran');
        $table->decimal('kembalian', 12, 2)->nullable()->after('cash_amount');
    });
}

public function down(): void
{
    Schema::table('penjualan', function (Blueprint $table) {
        $table->dropColumn(['cash_amount', 'kembalian']);
    });
}
};
