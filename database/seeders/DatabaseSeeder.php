<?php

namespace Database\Seeders;

use App\Models\MasterSetting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\ModelPermission;
use App\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $user = User::create([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('123456'),
            'user_type'=>'1',
            'is_active'=>'1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        $site = [];
        $site['store_name'] = "StackPOS";
        $site['store_phone'] = "123456";
        $site['store_email'] = "email@email.com";
        $site['tax_percentage'] = 0;
        $site['currency_symbol']    = '$';
        foreach ($site as $key => $value) {
            MasterSetting::updateOrCreate(['master_title' => $key], ['master_value' => $value]);
        }

        /* seeder call */
        $this->call([
            PermissionControllSeeder::class
        ]);

        /* permission update */
        $permissions = Permission::get();
        foreach ($permissions as $row) {
            ModelPermission::create([
                'user_id' => $user->id,
                'permission_id' => $row->id
            ]);
        }
    }
}
