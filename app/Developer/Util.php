<?php

namespace App\Developer;

use Illuminate\Database\Eloquent\Model;

class Util extends Model
{
    public static function saveFile($path, $fileName, $content)
    {
        $path = realpath($path);
       
        $response['status'] = false;
        $response['message'] = 'Uknown';
        $response = json_decode(json_encode($response));

        try{
            
            if (!file_exists($path)) mkdir($path, 0777, true);
            
            $filePath = $path.'\\'.$fileName;

            if($file = fopen($filePath, "w"))
            {
                if( fwrite($file, $content) ){
                    $response->status = true;
                    $response->message = $filePath.' Created';
                }else{
                    $response->status = false;
                    $response->message = $filePath.' fail';
                }
                fclose($file);
            }
        }catch(\Exception $e){
            $response->status = false;
            $response->message  = $e->getMessage();
        }

        return $response;
    }


    public static function getContentFile($path)
    {
        $pathFile = realpath($path);
        $content = $pathFile? file_get_contents($pathFile): null;
        return $content;
    }

    public static function getContentInArrayLines($path)
    {
        $content = [];
        if ($fh = fopen($path, 'r')) {
            while (!feof($fh)) {
                $line = fgets($fh);
                $content[] = $line;
            }
            fclose($fh);
        }

        return $content;
    }

    public static function isCommentedLine($text)
    {
        $line = trim($text);
        return substr($line, 0, 1) == "'"? true: false;
    }

    public static function functionType($text)
    {
        // dd($text);
        if( strripos($text, 'insertar') !== false ) return 'INSERT';
        if( strripos($text, 'modificar') !== false ) return 'UPDATE';
        if( strripos($text, 'eliminar') !== false ) return 'DELETE';
        if( strripos($text, 'seleccionar') !== false ) return 'SELECT';
        if( strripos($text, 'listar') !== false ) return 'SELECT';

        return 'UKNOWN';
    }

    public static function formatOneSpace($text)
    {
        if( strpos($text, '  ') !== false){
            $text = str_replace('  ', ' ', $text);
            return self::formatOneSpace($text);
        }
        return $text;
    }


    public static function typeAdoToSqlsvr($type)
    {
        $data = [
            'adInteger' => 'Int',
            'adVarChar' => 'VarChar',
            'adChar' => 'Char',
            'adWChar' => 'Nchar',
            'adBoolean' => 'Bit',
            'adDBTimeStamp' => 'DateTime',
            'adCurrency' => 'Money',
            'adBigInt' => 'Bigint',
            'adUnsignedTinyInt' => 'TinyInt',
            'adDouble' => 'Float',
            'adDate' => 'DateTime',
            'adVarWChar' => 'NVarChar',
            'adDecimal' => 'Decimal',
        ];

        return isset($data[$type])? $data[$type]: 'uknown';
    }

    // Class: TraduceSighDatos
    public static function formatValueProcedure($text){
        // SINTAXIS BASE: Iff(oTabla.Idatencion !== '', Null, oTabla.IdAtencion)"
        $pointPostFound = strpos($text, '.');
        if( $pointPostFound != false){
            //replace point wiht asterisk
            $text = substr($text, 0, $pointPostFound).'*'.lcfirst(substr($text, $pointPostFound+1, strlen($text)));
            return self::formatValueProcedure($text);
        }

        $text = str_replace('*', '.', $text);
        return $text;
    }
}
