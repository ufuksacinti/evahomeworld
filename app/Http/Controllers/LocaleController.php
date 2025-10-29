<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    /**
     * Switch language
     */
    public function switch(Request $request, $locale)
    {
        if (in_array($locale, ['tr', 'en'])) {
            session()->put('locale', $locale);
            app()->setLocale($locale);
        }
        
        return redirect()->back();
    }
}
