<?php

namespace Database\Seeders;

use App\Models\Languages;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;
use App\Models\Page;
class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            [
                'title' => 'home',
                'id_priority' => 0,
                'created_at' => new DateTime()
            ],
            [
                'title' => 'visualization',
                'id_priority' => 0,
                'created_at' => new DateTime()
            ],
            [
                'title' => 'virtual-reality',
                'id_priority' => 2,
                'created_at' => new DateTime()
            ],
           
            [
                'title' => 'news',
                'id_priority' => 3,
                'created_at' => new DateTime()
            ],
            [
                'title' => 'contact',
                'id_priority' => 4,
                'created_at' => new DateTime()
            ],
            [
                'title' => 'header',
                'id_priority' => 5,
                'created_at' => new DateTime()
            ],
        ]);

        // $page1 = Page::created([
        //     'title' => 'theme1',
        //             'id_priority' => 0,
        //             'created_at' => new DateTime()
        // ]);

    }
}
