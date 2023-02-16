<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Response;
use App\Models\User;
use Carbon\Carbon;

class ResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $users = collect(User::all()->modelKeys());
        $posts = collect(Post::all()->modelKeys());
        foreach ($posts as $post) {
            for ($i = 1; $i <= 5; $i++) {
                $data[] = [
                    'user_id' => $users->random(),
                    'response' => fake()->text(300),
                    'image' => fake()->imageUrl(640, 480),
                    'post_id' => $post,
                    'created_at' => $this->random_date()
                ];
            }
        }
        $chunks = array_chunk($data,10000);
        foreach ($chunks as $chunk){
            Response::insert($chunk);
        }
    }

    private function random_date(){
        $year = rand(2020, 2022);
        $month = rand(1, 12);
        $day = rand(1, 28);
        $hour = rand(1, 23);
        $minute = rand(1, 59);
        $second = rand(1, 59);
        $date_random = Carbon::create($year,$month ,$day , $hour, $minute, $second);
        return $date_random;
    }
}
