<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Cart extends Facade
{
    //berfungsi menggunakan kata cart di dalam project ini
    public static function getFacadeAccessor()
    {
        return 'cart';
    }
}
?>
