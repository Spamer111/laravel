<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Servises;
use App\Peopls;
use App\Partfolios;
use DB;

class IndexController extends Controller
{
    public function execute(Request $request) {
    $page=Page::all();
   // dd($page);
    $services=Servises::where('id','>',5)->get();// выборка , где id >5
        //dd($services); хелмпер для распечатки переменных
        //var_dump($services);
    $peopls=Peopls::take(3)->get();
    $portfolios=Partfolios::get(array('name','filter','images'));
    /*
    echo '<pre>';
    print_r($portfolios);
        echo '</pre>';
    */

    $tags = DB::table('partfolios')->distinct()->pluck('filter');// выбираем только уникальные(distinct) значения из таблицы partfolios из колонки filter
    //dd($tags);
    $menu =array();
    foreach ($page as $pages){
        $menu[] = ['title'=>$pages->name,'alias'=>$pages->alias];
    }

        $menu[] = ['title'=>'Service','alias'=>'service'];
        $menu[] = ['title'=>'Portfolio','alias'=>'Portfolio'];
        $menu[] = ['title'=>'team','alias'=>'team'];
        $menu[] = ['title'=>'contact','alias'=>'contact'];

    //dd($menu);


        return view('site.index',array(
            'menu'=>$menu,
            'page'=>$page,
            'services'=>$services,
            'peopls'=>$peopls,
            'portfolios'=>$portfolios,
            'tags'=>$tags,
        ));
    }
}
