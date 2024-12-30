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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang', 100)->unique();
            $table->unsignedBigInteger('id_kategori');
            $table->unsignedBigInteger('id_kondisi');
            $table->string('nama_barang', 100);
            $table->string('merek', 100);
            $table->integer('jumlah_aset');
            $table->integer('nilai_per_aset');
            $table->string('asal_perolehan', 100);
            $table->date('tahun_perolehan');
            $table->string('gambar_barang', 100);
            $table->enum('status_pinjaman', ['bisa', 'tidak']);
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('id_kategori')->references('id')->on('kategoris')->onDelete('cascade');
            $table->foreign('id_kondisi')->references('id')->on('kondisis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
