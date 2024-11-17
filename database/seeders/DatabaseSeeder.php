<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\About;
use App\Models\Category;
use App\Models\District;
use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '9800000000',
            'address' => 'text Address',
            'password' => 'password',
            'role'=>'customer',
            'image'=>'https://cdn2.iconfinder.com/data/icons/people-groups/512/Man_Woman_Avatar-512.png',
        ]);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone' => '9800000000',
            'address' => 'text Address',
            'password' => 'password',
            'role'=>'admin',
            'image'=>'https://cdn2.iconfinder.com/data/icons/people-groups/512/Man_Woman_Avatar-512.png',
        ]);

        Category::factory()->create([
            'name' => 'Basketball',
            
        ]);

        Category::factory()->create([
            'name' => 'Baseball',
           
        ]);

        Category::factory()->create([
            'name' => 'Tennis',
            
        ]);

        Category::factory()->create([
            'name' => 'Soccer',
            
        ]);

         Category::factory()->create([
            'name' => 'Javlin Throw',
            
        ]);

         Category::factory()->create([
            'name' => 'Other',
            
        ]);

        
 $dummyImagePath = 'images/dummy-image.jpg'; // Ensure this image exists in the storage folder

        // Create 20 dummy records
        foreach (range(1, 20) as $index) {
            About::create([
                'title' => 'Title ' . $index,
                'slogan' => 'Slogan ' . $index,
                'description' => 'Description for entry ' . $index,
                'image' => $dummyImagePath, // Replace with actual image path if available
                'others' => 'Additional information ' . $index,
            ]);
        }





        // Seeding Address
        
        // Seed Provinces
        $provinces = [
            ['name' => 'Koshi Pradesh'],
            ['name' => 'Madhesh Pradesh'],
            ['name' => 'Bagmati Pradesh'],
            ['name' => 'Gandaki Pradesh'],
            ['name' => 'Lumbini Pradesh'],
            ['name' => 'Karnali Pradesh'],
            ['name' => 'Sudurpashchim Pradesh'],
        ];

        // DB::table('provinces')->insert($provinces);
        // Province::insert($provinces);
        foreach ($provinces as $province) {
            Province::create($province);
        }
        // Seed Districts
        $districts = [
            // Koshi Pradesh
            ['name' => 'Bhojpur', 'province' => 'Koshi Pradesh'],
            ['name' => 'Dhankuta', 'province' => 'Koshi Pradesh'],
            ['name' => 'Ilam', 'province' => 'Koshi Pradesh'],
            ['name' => 'Jhapa', 'province' => 'Koshi Pradesh'],
            ['name' => 'Khotang', 'province' => 'Koshi Pradesh'],
            ['name' => 'Morang', 'province' => 'Koshi Pradesh'],
            ['name' => 'Okhaldhunga', 'province' => 'Koshi Pradesh'],
            ['name' => 'Panchthar', 'province' => 'Koshi Pradesh'],
            ['name' => 'Sankhuwasabha', 'province' => 'Koshi Pradesh'],
            ['name' => 'Solukhumbu', 'province' => 'Koshi Pradesh'],
            ['name' => 'Tehrathum', 'province' => 'Koshi Pradesh'],
            ['name' => 'Udayapur', 'province' => 'Koshi Pradesh'],
            
            // Madhesh Pradesh
            ['name' => 'Bara', 'province' => 'Madhesh Pradesh'],
            ['name' => 'Dhanusha', 'province' => 'Madhesh Pradesh'],
            ['name' => 'Mahottari', 'province' => 'Madhesh Pradesh'],
            ['name' => 'Maksus', 'province' => 'Madhesh Pradesh'],
            ['name' => 'Sarlahi', 'province' => 'Madhesh Pradesh'],
            ['name' => 'Sindhuli', 'province' => 'Madhesh Pradesh'],
            ['name' => 'Siraha', 'province' => 'Madhesh Pradesh'],
            
            // Bagmati Pradesh
            ['name' => 'Bhaktapur', 'province' => 'Bagmati Pradesh'],
            ['name' => 'Dhulikhel', 'province' => 'Bagmati Pradesh'],
            ['name' => 'Kathmandu', 'province' => 'Bagmati Pradesh'],
            ['name' => 'Lalitpur', 'province' => 'Bagmati Pradesh'],
            ['name' => 'Makwanpur', 'province' => 'Bagmati Pradesh'],
            ['name' => 'Ramechhap', 'province' => 'Bagmati Pradesh'],
            ['name' => 'Sindhupalchok', 'province' => 'Bagmati Pradesh'],
            
            // Gandaki Pradesh
            ['name' => 'Baglung', 'province' => 'Gandaki Pradesh'],
            ['name' => 'Gorkha', 'province' => 'Gandaki Pradesh'],
            ['name' => 'Kaski', 'province' => 'Gandaki Pradesh'],
            ['name' => 'Lamjung', 'province' => 'Gandaki Pradesh'],
            ['name' => 'Manang', 'province' => 'Gandaki Pradesh'],
            ['name' => 'Mustang', 'province' => 'Gandaki Pradesh'],
            ['name' => 'Myagdi', 'province' => 'Gandaki Pradesh'],
            ['name' => 'Nepalgunj', 'province' => 'Gandaki Pradesh'],
            ['name' => 'Syangja', 'province' => 'Gandaki Pradesh'],
            
            // Lumbini Pradesh
            ['name' => 'Arghakhanchi', 'province' => 'Lumbini Pradesh'],
            ['name' => 'Dang', 'province' => 'Lumbini Pradesh'],
            ['name' => 'Deukhuri', 'province' => 'Lumbini Pradesh'],
            ['name' => 'Kapilvastu', 'province' => 'Lumbini Pradesh'],
            ['name' => 'Nawalpur', 'province' => 'Lumbini Pradesh'],
            ['name' => 'Palpa', 'province' => 'Lumbini Pradesh'],
            ['name' => 'Rupandehi', 'province' => 'Lumbini Pradesh'],
            
            // Karnali Pradesh
            ['name' => 'Dailekh', 'province' => 'Karnali Pradesh'],
            ['name' => 'Dolpa', 'province' => 'Karnali Pradesh'],
            ['name' => 'Humla', 'province' => 'Karnali Pradesh'],
            ['name' => 'Jajarkot', 'province' => 'Karnali Pradesh'],
            ['name' => 'Kalikot', 'province' => 'Karnali Pradesh'],
            ['name' => 'Mugu', 'province' => 'Karnali Pradesh'],
            ['name' => 'Salyan', 'province' => 'Karnali Pradesh'],
            
            // Sudurpashchim Pradesh
            ['name' => 'Doti', 'province' => 'Sudurpashchim Pradesh'],
            ['name' => 'Kailali', 'province' => 'Sudurpashchim Pradesh'],
            ['name' => 'Kanchanpur', 'province' => 'Sudurpashchim Pradesh'],
        ];

        foreach ($districts as $district) {
            $provinceId = Province::where('name', $district['province'])->value('id');
            District::create([
                'name' => $district['name'],
                'province_id' => $provinceId,
            ]);
        }

    }
}