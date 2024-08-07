<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    public function switch(Request $request)
    {
//        dd($request->all());

        $locale = $request->input('locale');
        if (in_array($locale, ['en', 'ar'])) {
            App::setLocale($locale);
//            \app()->setLocale($locale);
            session()->put('locale', $locale);
        }
        return Redirect::back();
    }
}
