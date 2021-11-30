<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Contact;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::factory(5)->create();

         Client::factory(5)->create()->each(function($client) {
             $client->contacts()->createMany(
                 Contact::factory(5)->make()->toArray()
             );
         });
    }
}
