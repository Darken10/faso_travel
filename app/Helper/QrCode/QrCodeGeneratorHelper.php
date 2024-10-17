<?php

namespace App\Helper\QrCode;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

class QrCodeGeneratorHelper {

    /**
     * @param string $code
     * @return string|null exemple d'uri : tickets/qrcode/le_name.png
     *
     */
    public static function generate($code): ?string{
        $qrCode = Builder::create()
        ->writer(new PngWriter())
        ->data($code)
        ->size(200)
        ->margin(10)
        ->build();

        $name = Str::random(10).'-'.uniqid().date('Y').date('m').date('d').date('h').date('m');
        $uri = "tickets/qrcode/$name.png";

        $path = storage_path("app/public/$uri");
        $qrCode->saveToFile($path);
        if(file_exists($path)){
            return $uri;
        }
        return null;
    }

}
