<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\User;
use App\Question;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        {
            factory(User::class, 3)->create()->each(function ($u) {
                $u->questions()
                    ->saveMany(
                        factory(Question::class, rand(1, 5))->make()
                    )
                    ->each(function ($q) {
                        $q->answers()->saveMany(factory(App\Answer::class, rand(1, 5))->make());
                    });
            });
        }

        $date = Carbon::now();
        DB::table('users')->insert([
            [
                'name'              => "Jean-Luc Petelot",
                'email'             => "jlpetelot@madinici.org",
                'email_verified_at' => NULL,
                'password'          => bcrypt('12345678'),
                'remember_token'    => bcrypt(rand(1,10)),
                'created_at'        => $date,
                'updated_at'        => $date,
            ]
        ]);
    }
}
