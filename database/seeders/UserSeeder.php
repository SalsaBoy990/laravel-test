<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User as User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(100)->create()
            ->each(function ($user) {
                Recipe::factory( rand(1, 7) )->create(
                    [
                        'user_id' => $user->id,
                    ]
                )
                ->each(function ($recipe) {
                    $tag_ids = range(1,8);
                    shuffle($tag_ids);
                    $assignments = array_slice($tag_ids, 0, rand(0,8));

                    foreach($assignments as $tag_id) {
                        // db facades is not managing the datetime columns
                        // if you do not have a model, use DB, otherwise use Eloquent!
                        DB::table('recipe_tag')
                            ->insert(
                                [
                                    'recipe_id' => $recipe->id,
                                    'tag_id' => $tag_id,
                                    'created_at' => Now(),
                                    'updated_at' => Now(),
                                ]
                            );
                    }
                });
            });
    }
}
