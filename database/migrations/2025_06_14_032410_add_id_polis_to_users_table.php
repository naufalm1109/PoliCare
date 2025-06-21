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
        Schema::table('users', function (Blueprint $table) {
            //Hapus kolom poli yang lama
            if (Schema::hasColumn('users', 'poli')) {
                $table->dropColumn('poli');
            }

            //Tambahkan foreign key id_poli yang mereferensi ke tabel poli
            $table->foreignId('id_poli')
                  ->nullable()
                  ->constrained('polis') // Merujuk ke tabel 'poli'
                  ->onDelete('set null'); // Set foreign key sebagai nullable dengan action onDelete set null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('id_poli');
            
        });
    }
};
