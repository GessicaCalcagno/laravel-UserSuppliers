<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class UpdateUserTypeEnumInUsersTable extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN user_type ENUM('cliente', 'fornitore', 'admin') NOT NULL");
    }

    public function down()
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN user_type ENUM('cliente', 'fornitore') NOT NULL");
    }
}

