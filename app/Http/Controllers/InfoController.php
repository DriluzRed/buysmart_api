<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Helpers\Helper;
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
        $security = Helper::replaceVariables($security->value);
        return view('frontend.info.security-policy')->with('security', $security);
    }

    public function terms()
    {
        $terms = Setting::where('key', 'terms')->first();
        $terms = Helper::replaceVariables($terms->value);
        return view('frontend.info.terms-service')->with('terms', $terms);
    }

}
