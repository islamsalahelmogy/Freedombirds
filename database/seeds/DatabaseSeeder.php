<?php

use App\User;
use App\Post;
use Illuminate\Database\Eloquent\Factory;
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
       
        /*انا هنابزود كولوم في جدول انا عايزه بدل ما اعملو من الميجريشن عملتو  من هنا */
         /*Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            //$table->string('phone')->after('password')->default("01143294789");
        }); */
            
        /*بدم عملت اكتر من سيدر فيل يبقي لازم في الاخر لازم اناديهم كلهم  في الداتابيز سيدر */
        $this->call(PostTableSeeder::class);

        /*لو عايز ارن سيدر معين فقط  */
        /*php artisan db:seed --class=PostsTableSeeder  */

        /*بدل ما انادي سيدر سيدر لا انا ممكن اناديهم كلهم لوكشة واحدة  */
        /*  $this->call([
            UsersTableSeeder::class,
            PostsTableSeeder::class,
            CommentsTableSeeder::class,
            ]); */

    }
}
