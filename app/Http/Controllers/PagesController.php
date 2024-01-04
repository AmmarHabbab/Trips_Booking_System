<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App;

class PagesController extends Controller
{
    public function dashboard()
    {
        return view('pages.dashboard');
    }

    public function lang()
    {
       // app()->setLocale('ar');
     //   dd(app()->getLocale());
        // if(app()->getLocale() == 'en')
        // {
        //     app()->setLocale('ar');
        //     session()->put('locale','ar');
        // }
        // else
        // {
        //     app()->setLocale('en');
        //     session()->put('locale','en');
        // }

        // App::setLocale('ar');

        // if(App::getLocale() == 'en')
        // {
        //     App::setLocale('ar');
        // }
        // else
        // {
        //     App::setLocale('en');
        // }
        
        return redirect()->back();
    }
}
