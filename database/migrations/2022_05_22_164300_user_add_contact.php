<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserAddContact extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('users', function($table) {
            $table->text('telegram')->nullable();
            $table->text('whatsapp')->nullable();
            $table->text('wickr')->nullable();
            $table->text('xmpp')->nullable();
            $table->text('mail')->nullable();
            $table->boolean('show_instant')->default(false);
            $table->boolean('show_mail')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
         Schema::table('users', function($table) {
            $table->dropColumn('telegram');
            $table->dropColumn('whatsapp');
            $table->dropColumn('wickr');
            $table->dropColumn('xmpp');
            $table->dropColumn('mail');
            $table->dropColumn('show_instant');
            $table->dropColumn('show_mail');
        });
    }
}
