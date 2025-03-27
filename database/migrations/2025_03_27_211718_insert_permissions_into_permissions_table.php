<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class InsertPermissionsIntoPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Inserir os dados na tabela permissions
        DB::table('permissions')->insert([
            ['permission_name' => 'product-management'],
            ['permission_name' => 'category-management'],
            ['permission_name' => 'brand-management'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remover as permissões inseridas (opcional)
        DB::table('permissions')->whereIn('permission_name', [
            'product-management', 
            'category-management', 
            'brand-management'
        ])->delete();
    }
}
