<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\User;
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
        $user1 = User::where('name', 'User1')->get();
        $user2 = User::where('name', 'User 2')->get();
        $testUsers = [$user1, $user2];
        foreach ($testUsers as $user){
            $about = "Hello, my name is {$user[0]["name"]} and I am a poster";
            Page::factory()->create([
                'title' => 'Who I Am',
                'body' => $about,
                'published' => '1',
                'user_id' => $user[0]["id"]
            ]);

            $contactInfo = "Email: {$user[0]["email"]}";
            Page::factory()->create([
                'title' => 'Contact Me',
                'body' => $contactInfo,
                'published' => '1',
                'user_id' => $user[0]["id"]
            ]);
        }

        $users = User::factory(10)->create();
        foreach ($users as $user){
            $intro = "Hi, my name is {$user["name"]} and nice to meet you!";
            Page::factory()->create([
                'title' => 'This is me',
                'body' => $intro,
                'published' => '1',
                'user_id' => $user["id"]
            ]);

            $contactInfo = "Email: {$user["email"]}";
            Page::factory()->create([
                'title' => 'Contact Me',
                'body' => $contactInfo,
                'published' => '1',
                'user_id' => $user["id"]
            ]);
        }


        Post::factory(10)->create();

    }
}
