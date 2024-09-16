<?php

namespace App\Helper\QrCode;

use Illuminate\Support\Str;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

class QrCodeGeneratorHelper {

    public static function generate($code): string {
        $qrCode = Builder::create()
        ->writer(new PngWriter())
        ->data($code)
        ->size(200)
        ->margin(10)
        ->build();

        $name = Str::random(10).'-'.uniqid().date('Y').date('m').date('d').date('h').date('m');
        $path = storage_path("app/public/tickets/qrcode/$name.png");
        $qrCode->saveToFile($path);

        if(file_exists($path)){
            return $path;
        }
        return null;
    }

}