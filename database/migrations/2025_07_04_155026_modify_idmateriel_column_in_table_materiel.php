<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyIdmaterielColumnInTableMateriel extends Migration
{
    public function up()
    {
        Schema::table('materiel', function (Blueprint $table) {
            $table->integer('idmateriel')->nullable()->change();
            // ou
            $table->integer('idmateriel')->default(0)->change();
        });
    }

    public function down()
    {
        Schema::table('materiel', function (Blueprint $table) {
            $table->integer('idmateriel')->nullable(false)->change();
        });
    }
}