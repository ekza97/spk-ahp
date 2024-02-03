<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use App\Models\RandomIndex;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $random_index = [
            ['jumlah' => '1','nilai' => '0'],
            ['jumlah' => '2','nilai' => '0'],
            ['jumlah' => '3','nilai' => '0.5799999833106995'],
            ['jumlah' => '4','nilai' => '0.8999999761581421'],
            ['jumlah' => '5','nilai' => '1.1200000047683716'],
            ['jumlah' => '6','nilai' => '1.2400000095367432'],
            ['jumlah' => '7','nilai' => '1.3200000524520874'],
            ['jumlah' => '8','nilai' => '1.409999966621399'],
            ['jumlah' => '9','nilai' => '1.4500000476837158'],
            ['jumlah' => '10','nilai' => '1.4900000095367432'],
            ['jumlah' => '11','nilai' => '1.5099999904632568'],
            ['jumlah' => '12','nilai' => '1.5399999618530273'],
            ['jumlah' => '13','nilai' => '1.559999942779541'],
            ['jumlah' => '14','nilai' => '1.5700000524520874'],
            ['jumlah' => '15','nilai' => '1.590000033378601'],
            ['jumlah' => '16','nilai' => '1.600000023841858'],
        ];
        foreach ($random_index as $row) {
            RandomIndex::create([
                'jumlah' => $row['jumlah'],
                'nilai' => $row['nilai']
            ]);
        }
        $permissions = ['create user','read user','edit user','delete user','create permission','read permission','delete permission','create role','read role','edit role','delete role','read ranking','read kriteria','bobot kriteria','matrik kriteria','read alternatif','bobot alternatif','matrik alternatif'];
        foreach($permissions as $item){
            Permission::create([
                'name'=>$item
            ]);
        }

        $role = Role::create([
            'name'=>'admin'
        ]);
        $role->givePermissionTo($permissions);

        $user = User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'type'=>'admin'
        ]);
        $user->assignRole($role);
    }
}