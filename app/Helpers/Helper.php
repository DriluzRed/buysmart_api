<?php

namespace App\Helpers;
use App\Models\City;
use App\Models\Department;
use App\Models\Neighborhood;
use App\Models\PaymentMethod;
use App\Models\Setting;

class Helper
{
    const app = 'BuySmart';
    const version = '1.0.0';
    const author = 'GOAL S.A';



    public static function getConstants()
    {
        return [
            'app' => self::app,
            'version' => self::version,
            'author' => self::author
        ];
    }

    public static function getConfigurations()
    {
        $configurations = Setting::all()->pluck('value', 'key');
        return $configurations;
    }

    public static function formatPrice($price)
    {
        return number_format($price, 0, ',', '.');
    }

    public static function phonePrefixes() : array
    {
        $prefixes = [
          '0991',
          '0992',
          '0993',
          '0994',
          '0995',
          '0981',
          '0982',
          '0983',
          '0984',
          '0985',
          '0986',
          '0987',
          '0971',
          '0972',
          '0973',
          '0974',
          '0975',
          '0976',
          '0961',
          '0962',
          '0963'
        ];

        return $prefixes;
    }

    public function getDepartments()
    {
        return Department::all();
    }

    public function getCities()
    {
        return City::all();
    }

    public function getNeighborhoods()
    {
        return Neighborhood::all();
    }

    public static function getAddresses()
    {
        return auth()->guard('customer')->user()->addresses;
    }

    public static function getPaymentMethods()
    {
        return PaymentMethod::where('is_active', 1)->get();
    }

    public static function getDeliveryCost()
    {
        return (Setting::where('key', 'delivery_cost')->first()->value);
    }

    public static function replaceVariables($data){
        $variables = [
            '{empresa}' => env('ENTERPRISE', 'GoCommerce'),
            '{contacto}' => env('CONTACT_EMAIL', 'soporte@goal.com'),
            '{pais}' => env('COUNTRY', 'Paraguay'),
        ];

        return str_replace(array_keys($variables), array_values($variables), $data);
    }

    public static function getTermsAndConditions()
    {
        $terms = Setting::where('key', 'terms')->first();
        return self::replaceVariables($terms->value);
    }

    public static function sendCartViaWhatsApp($data)
    {
        
    }
    
}
