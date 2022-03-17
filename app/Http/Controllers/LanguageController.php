<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    private $langActive = [
        'vi',
        'en',
    ];

    public function changeLanguage(Request $request, $lang)
    {
        if (in_array($lang, $this->langActive)) {
            $request->session()->put([
                'lang' => $lang,
            ]);

            return redirect()->back();
        }
    }
}
