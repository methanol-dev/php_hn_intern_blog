<?php

use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            DB::table('users')->insert([
                'role_id' => Role::IS_ADMIN,
                'first_name' => 'admin',
                'last_name' => 'admin',
                'email' => 'admin@admin.co',
                'email_verified_at' => now(),
                'username' => 'admin',
                'password' => bcrypt('123456'),
                'avatar' => 'default.jpg',
                'status' => User::UN_BLOCK,
                'remember_token' => Str::random(10),
            ]);

            factory(User::class, 10)->create()->each(function ($user) {
                $user->posts()->saveMany(factory(Post::class, 5)->create()->each(function ($post) use ($user) {
                    $post->comments()->saveMany(factory(Comment::class, 5))->create([
                        'user_id' => $user->id,
                    ]);
                }));
            });
        });
    }
}
