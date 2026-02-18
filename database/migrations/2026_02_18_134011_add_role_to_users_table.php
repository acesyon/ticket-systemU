<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->after('password');
            $table->string('contact_no')->nullable()->after('email');
            $table->string('middle_name')->nullable()->after('name');
            $table->softDeletes();
        });
        
        // Rename name column to first_name and add last_name
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'first_name');
            $table->string('last_name')->after('id');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'contact_no', 'middle_name', 'deleted_at']);
            $table->renameColumn('first_name', 'name');
            $table->dropColumn('last_name');
        });
    }
};