<?php

namespace Database\Seeders;

use App\Models\DescriptionHome;
use App\Models\Jumbotrons;
use App\Models\ProdukHome;
use App\Models\SuggestionHome;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

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

        DescriptionHome::create([
            'description_home' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam magnam pariatur necessitatibus, ex assumenda veniam nostrum hic quaerat laudantium fuga. Ex perspiciatis maxime nesciunt? Sequi corrupti iusto vel nam.
            Culpa enim assumenda eius illo ipsam? Repellat aperiam ratione error? Corrupti nostrum impedit ipsam eos, minima atque! Sed at, consequatur, dolor sint recusandae harum iusto ratione provident eius qui inventore."
        ]);

        // jumbotron image
        Jumbotrons::create([
            'image_description' => 'krupuk_png.png'
        ]);

        // produk image
        ProdukHome::create([
            'image_produk' => 'kerupuk_tenggiri_1.png'
        ]);
        ProdukHome::create([
            'image_produk' => 'kerupuk_tenggiri_2.png'
        ]);
        ProdukHome::create([
            'image_produk' => 'kerupuk_tenggiri_3.png'
        ]);

        // suggestion image

        SuggestionHome::create([
            'image_suggestion' => 'kerupuk_gepeng.png'
        ]);
        Role::create([
            'name' => 'admin',
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Role::create([
            'name' => 'customer',
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $admin = User::create([
            'username' => 'admin',
            'name' => 'admin akun',
            'email' => 'admin@gmail.com',
            'birthday' => Carbon::create('2000', '01', '01'),
            'phone_number' => '-',
            'address' => '-',
            'password' => bcrypt('admin123'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $admin->assignRole('admin');
        event(new Registered($admin));
    }
}
