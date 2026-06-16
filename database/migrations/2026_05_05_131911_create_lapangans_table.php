<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lapangans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('kode_lapangan')->unique();
            $table->string('nama_lapangan');
            $table->enum('kategori', ['Futsal', 'Badminton', 'Basket', 'Padel']); 
            $table->string('lokasi');
            $table->decimal('harga_per_jam', 10, 2);
            $table->boolean('is_available')->default(true);
            $table->string('email_kontak')->nullable(); 
            $table->string('foto_lapangan')->nullable(); 
            
            $table->timestamps();
        });
    }
};
