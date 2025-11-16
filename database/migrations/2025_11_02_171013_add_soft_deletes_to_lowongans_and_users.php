<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
    * Run the migrations.
    */

    public function up(): void {
        Schema::table( 'lowongans', fn( $t )=>$t->softDeletes() );
        Schema::table( 'users', fn( $t )=>$t->softDeletes() );
    }

    public function down(): void {
        Schema::table( 'lowongans', fn( $t )=>$t->dropSoftDeletes() );
        Schema::table( 'users', fn( $t )=>$t->dropSoftDeletes() );
    }

}
;
