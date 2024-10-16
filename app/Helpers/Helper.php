<?php
namespace App\Helpers;

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

    public static function formatPrice($price)
    {
        return 'Gs '.number_format($price, 0, ',', '.');
    }
}