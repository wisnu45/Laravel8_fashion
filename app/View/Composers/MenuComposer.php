<?php

namespace App\View\Composers;

use App\Models\Menu;
use Illuminate\View\View;

class MenuComposer
{

    
   
    public function __construct()
    {
       
    }

    public function compose(View $view)
    {
        $menu=Menu::select('id','name','active','parent_id')->where('active',1)->orderByDesc('id')->get();
        $view->with('menus', $menu);
    }
}