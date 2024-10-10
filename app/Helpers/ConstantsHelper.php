<?php
namespace App\Helpers;

class ConstantsHelper 
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
}