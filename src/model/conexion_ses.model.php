<?php 
require 'vendor/autoload.php';


use Aws\Ses\SesClient; 
use Aws\Exception\AwsException;

class Conexion_Ses {
    $SesClient = new Aws\Ses\SesClient
    ([
    'profile' => 'default',
    'version' => '2010-12-01',
    'region' => 'us-east-2'
    ]);



}

?>