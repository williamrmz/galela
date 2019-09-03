<?php

namespace App\Developer;

use Illuminate\Database\Eloquent\Model;
use App\Developer\Util;

class TraduceSighComun extends Model
{
    public static function generaClases($dirOrigen, $dirDestino)
    {
        $ficherosData = scandir($dirOrigen);
        $nombreFicheros = [];
        foreach($ficherosData as $nombreFichero){
            $size = strlen($nombreFichero);
            $ext = strtolower( substr($nombreFichero, $size-4, $size) );
            if($ext == '.cls'){
                $nombreFicheros[] = $nombreFichero;
            }
        }
        // Num files: 404
        // dd($nombreFicheros);

        foreach($nombreFicheros as $nombreFichero){
            // echo $nombreFichero.'<br>';
            $pathFile = $dirOrigen.'\\'.$nombreFichero;
            $content = Util::getContentInArrayLines( $pathFile );
            
            $scriptData[] = self::getScriptArrayPHP( $content );
        }

        // dd($scriptData);
        // Num files: 404

        $dataTest = array_slice($scriptData, 0, 404);
        // dd($dataTest);

        self::generateFileClass($dataTest, $dirDestino);
        // dd($scriptData);
    }

    private static function generateFileClass($data, $dirDestino)
    {
        foreach ($data as $row){
            $className = ucfirst($row['className']);
            $functions = $row['functions'];
            // dd($functions);

            $fileName = $className.'.php';


            $fillableArray = self::writeFillableArray($functions);

            $content = "<?php\n\n";
            $content .= "namespace App\VB\SIGHComun;\n\n";
            $content .= "use Illuminate\Database\Eloquent\Model;\n\n";
            $content .= "use DB;\n\n";
            $content .= "class $className extends Model\n";
            $content .= "{\n";
                $content .= "\tpublic \$timestamps = false;\n\n";
                $content .= "\tpublic \$incrementing = false;\n\n";
                $content .= "$fillableArray";
            $content .= "\n}";

            // dd($content);

            $op = Util::saveFile($dirDestino, $fileName, $content);
            if($op->status){
                echo "<p style='color:blue'>$op->message</p>";
            }else{
                echo "<p style='color:red'>$op->message</p>";
            }
        }
    }

    private static function getScriptArrayPHP($content)
    {
        // dd($content);
        $className = null;
        $properties = [];
        $functions = [];

        //FIND FUNCTIONS...
        $functions = [];
        $indexData = 0;
        foreach($content as $line){
            $line = trim($line);
            $wordVB_Name  = 'VB_Name';
            $wordDim = 'Dim';
            $wordProperty = 'Property';

            if( Util::isCommentedLine($line)) continue;

            // CLASSNAME
            $wordVB_NamePos = strpos($line, $wordVB_Name);
            if($wordVB_NamePos !== false){
                $nameClassPos1 = strpos($line, '"') + 1;
                $nameClassPos2 = strrpos($line, '"') - $nameClassPos1;
                $className = substr($line, $nameClassPos1, $nameClassPos2);
                // dd($className);
            }

            // DIMS
            $wordDimPos = strripos($line, $wordDim);
            if($wordDimPos === 0){
                $dim = [];
                $dimArray = explode(' ', $line);
                if(count($dimArray) == 4) //basado en la sintaxis 'Dim name_dim As data_type'
                {
                    $dim['name'] = isset($dimArray[1])? $dimArray[1]: 'uknown';
                    $dim['type'] = isset($dimArray[3])? $dimArray[3]: 'uknown';
                }
                if (isset($dim)) $properties[] = $dim;
            }

            // PROPERTIES
            $wordPropertyPos = strripos($line, $wordProperty);
            if($wordPropertyPos === 0){
                //SINTAXIS BASE: Property Let IdSolicitudEspecialidad(iValue As Long)
                $line = Util::formatOneSpace($line);
                $lineArray = explode(' ', $line);

                $function['type'] = isset($lineArray[1])? $lineArray[1]: 'uknown';

                $nameProperty = 'uknown';
                if(isset($lineArray[2])){
                    $nameData = $lineArray[2];
                    $nameProperty = substr($nameData, 0, strpos($nameData, '('));
                }
                $function['name'] = $nameProperty;

                //Obtener parametros
                //SINTAXIS BASE: name_param AS type_param
                $paramPos1 = strpos($line, '(')+1;
                $paramPos2 = strpos($line, ')') -  $paramPos1;
                $paramData = substr($line, $paramPos1, $paramPos2);
                $paramArray = explode(' ', $paramData);

                $param = [];
                if(count($paramArray) === 3){
                    $param['name'] = $paramArray[0];
                    $param['type'] = $paramArray[2];
                }
                $function['param'] = $param;

                if (isset($function)) $functions[] = $function;
            }
            // dd($line);
        }

        $script['className'] = $className;
        $script['functions'] = $functions;
        $script['properties'] = $properties;
        return $script;
    }

    private static function writeFillableArray($functions)
    {
        $script = "\tpublic \$fillable = [\n";
        foreach($functions as $function){
            if($function['type']=='Get'){
                $name = lcfirst($function['name']);
                $script .= "\t\t'$name', \n";
            }
        }
        $script .= "\t];";
        return $script;
    }

}
