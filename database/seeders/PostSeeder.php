<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;


class PostSeeder extends Seeder
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

        for ($i = 1; $i <= 10000; $i++) {
            $data[] = [
                'title' => fake()->sentence(),
                'user_id' => $users->random(),
                'problem' => fake()->text(500),
                'image' => fake()->imageUrl(1272, 320),
                'created_at' => $this->random_date()
            ];
        }
        $chunks = array_chunk($data,5000);
        foreach ($chunks as $chunk){
            Post::insert($chunk);
        }
    }

    private function random_date(){
        $year = rand(2022, 2021);
        $month = rand(1, 12);
        $day = rand(1, 28);
        $hour = rand(1, 23);
        $minute = rand(1, 59);
        $second = rand(1, 59);
        $date_random = Carbon::create($year,$month ,$day , $hour, $minute, $second);
        return $date_random;
    }
}
