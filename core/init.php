<?php
// if(session_status() == PHP_SESSION_NONE && isset($_SERVER['HTTP_HOST'])){
//     session_set_cookie_params(NULL, '/; samesite=Lax', $_SERVER['HTTP_HOST'] , true, true);
//     session_name("__Secure-AID");
//     session_start();
// }
session_start();
include_once("config.php");

function globalAutoload($class)
{
    require_once "classes/{$class}.php";
}

spl_autoload_register('globalAutoload');

function oldCategories()
{
    return [];
    return [
        'Engine Oils' => 'Lubircants and Motor Oil',
        'Gearbox Oils' => 'Lubircants and Motor Oil',
        'Engine And Radiator Coolants' => 'Radiator and Service Fluids',
        'Lubricants And Grease' => 'Greases',
        'Protection And Detailing' => 'Cleaners and Service',
        'Adhesives And Sealants' => 'Gaskets and Adhesives',
        'Car Care' => 'Appearance',
        'Air Freshners And Scents' => 'Air Freshners'
    ];
}
$sysPath = "/xampp/abro-tree-sys/";
$abro =  new Abro($sysPath, BASE_URL, PUBLIC_PATH, '/xampp/abro-tree-sys/');
