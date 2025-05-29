<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    public function up()
    {
        Role::create(['name' => 'partner', 'guard_name' => 'web']);
        Role::create(['name' => 'manager', 'guard_name' => 'web']);
        Role::create(['name' => 'applicant', 'guard_name' => 'web']);
    }

    public function down()
    {
        Role::whereIn('name', ['partner', 'manager', 'applicant'])->delete();
    }
};