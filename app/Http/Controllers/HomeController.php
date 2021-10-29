<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\SubMenu;
use App\Models\Image;
use App\Models\Ad;
use App\Models\News;
use App\Models\Mvim;

class HomeController extends Controller
{

    public function index()
    {
        $this->sidebar();
        
        $news=News::where('sh',1)->get()->filter(function ($value, $key) {
            if($key>4){
                $this->view['more']='/news';
                return null;
            }else{
                return $value;
            }
        });
        $mvim=Mvim::where('sh',1)->get();

        $this->view['news'] = $news;
        $this->view['mvim'] = $mvim;

        return view('main',$this->view);
    }

    protected function sidebar(){
        $menus=Menu::where('sh',1)->get();
        $images=Image::where('sh',1)->get();
        $ad=Ad::where('sh',1)->get()->pluck('text')->all();
        $ads=implode("     ",$ad);

        foreach($menus as $k => $menu){
            $menus[$k]['subs'] =  $menu->subs;
        }

        $this->view['menus'] = $menus;
        $this->view['images'] = $images;
        $this->view['ads'] = $ads;
    }

}
