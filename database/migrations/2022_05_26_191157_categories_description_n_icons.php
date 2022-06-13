<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoriesDescriptionNIcons extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('categories', function($table) {
            $table->text('icon')->nullable();
            $table->text('description')->nullable();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('categories', function($table) {
            $table->dropColumn('icon');
            $table->dropColumn('description');
        });
    }
}
