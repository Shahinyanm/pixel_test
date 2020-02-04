<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class LocalizationController extends Controller
{
    /**
     * change App locale
     *
     * @param $locale
     * @return RedirectResponse
     */
    public function __invoke($locale)
    {
        \App::setLocale($locale);
        session()->put('locale', $locale);

        return back();
    }
}
