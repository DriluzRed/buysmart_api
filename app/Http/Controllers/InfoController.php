<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
class InfoController extends Controller
{
    public function faq()
    {
        $faqSetting = Setting::where('key', 'faqs')->first();
        $faqs = $faqSetting ? json_decode($faqSetting->value) : [];
        return view('frontend.info.faq')->with('faqs', $faqs);
    }

    public function security()
    {
        $security = Setting::where('key', 'security')->first();
        return view('frontend.info.security-policy')->with('security', $security->value);
    }

    public function terms()
    {
        $terms = Setting::where('key', 'terms')->first();
        return view('frontend.info.terms-service')->with('terms', $terms->value);
    }

}
