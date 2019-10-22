<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\facades\schema; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        schema::defaultStringLength(191);
       /* View::composer('layouts.app', function( $view )
        {
            $data = Category::all();
            // foreach(Sub_SubCategory::all() as $subsub) {
            //     foreach(SubCategory::all() as $sub) {
            //         if($sub->id == $subsub->subcategory_id) {
            //             foreach(Category::all() as $cat) {
            //                 if($cat->id == $sub->category_id) {
            //                     if(!in_array($cat,$data))
            //                     {
            //                         array_push($data,$cat);
            //                     }
            //                 }
            //             }
            //         }
            //     }
            // }
            //dd($cat);
            //pass the data to the view
            $view->with( 'data', $data );
        });*/

    }

}
