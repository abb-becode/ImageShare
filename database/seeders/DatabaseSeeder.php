<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
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
        // don't truncate tables but execute seeder only when refresh database
//        User::truncate();
//        Post::truncate();
//        Category::truncate();



        /*$user = User::factory()->create([
           'name' => 'John Doe'
        ]);

        Post::factory(5)->create([
            'user_id' => $user->id
        ]);*/

        $this->call([
          RoleSeeder::class,
          UserSeeder::class,
          CategorySeeder::class
        ]);








//        $user = User::factory()->create();
//
//        $personal = Category::create([
//           'name' => 'Personal',
//           'slug' => 'personal'
//        ]);
//
//        $family = Category::create([
//           'name' => 'Family',
//           'slug' => 'family'
//        ]);
//
//        $work = Category::create([
//           'name' => 'Work',
//           'slug' => 'work'
//        ]);
//
//        Post::create([
//            'user_id' => $user->id,
//            'category_id' => $family->id,
//            'title' => 'My Family Post',
//            'slug' => 'my-family-post',
//            'excerpt' => 'Lorem ipsum dolar sit met.',
//            'body' => '<p>Lorem ipsum dolar sit amet, consectetur adipiscing elt. Morbi viverra.</p>'
//        ]);
//
//        Post::create([
//            'user_id' => $user->id,
//            'category_id' => $work->id,
//            'title' => 'My Work Post',
//            'slug' => 'my-work-post',
//            'excerpt' => 'Lorem ipsum dolar sit met.',
//            'body' => '<p>Lorem ipsum dolar sit amet, consectetur adipiscing elt. Morbi viverra.</p>'
//        ]);


    }
}
