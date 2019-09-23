<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        /* انا هنا رايح استخدم ال فاكتوري الي عملتو للبوست  */
        factory(Post::class,10)->create();
    }
}
