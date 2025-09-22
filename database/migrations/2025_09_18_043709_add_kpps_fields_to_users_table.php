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
            $table->string('nik', 16)->unique()->after('id');
            $table->text('alamat')->nullable()->after('email');
            $table->string('tps')->nullable()->after('alamat');
            $table->string('desa')->nullable()->after('tps');
            $table->string('kecamatan')->nullable()->after('desa');
            $table->string('kabupaten')->nullable()->after('kecamatan');
            $table->string('provinsi')->nullable()->after('kabupaten');
            $table->string('no_wa')->nullable()->after('provinsi');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'nik','alamat','tps','desa','kecamatan','kabupaten',
                'provinsi','no_wa','role'
            ]);
        });
    }
};
