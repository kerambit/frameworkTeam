<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 100)->make(['group_id' => null])
            ->each(function ($user) {
                $group = \App\Group::inRandomOrder()->first();
                $user->group_id = $group->id;
                $user->save();
            });
    }
}
