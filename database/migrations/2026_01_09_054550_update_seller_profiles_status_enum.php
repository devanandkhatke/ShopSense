<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up()
    {
        DB::statement("
            ALTER TABLE seller_profiles
            MODIFY status ENUM(
                'pending',
                'approved',
                'kyc_pending',
                'kyc_verified',
                'rejected',
                'suspended'
            ) DEFAULT 'pending'
        ");
    }

    public function down()
    {
        DB::statement("
            ALTER TABLE seller_profiles
            MODIFY status ENUM(
                'pending',
                'approved',
                'rejected'
            ) DEFAULT 'pending'
        ");
    }
};
