<?php

namespace App\Developer;

use Illuminate\Database\Eloquent\Model;
use App\Developer\Util;

class TraduceSighDatos extends Model
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

        foreach($nombreFicheros as $nombreFichero){
            // echo $nombreFichero.'<br>';
            $nombreScript = substr($nombreFichero, 0, strpos ($nombreFichero, '.') ).'.php';
            // dd($nombreFichero);
            // $content = Util::getContentFile( $dirOrigen.'\\'.$nombreFichero );
            $pathFile = $dirOrigen.'\\'.$nombreFichero;
            $content = Util::getContentInArrayLines( $pathFile );
            $scriptData[] = self::getScriptArrayPHP( $content );

            // $op = Util::saveFile($dirDestino, $nombreScript, $content);
            // dd($op);
        }

        // dd($scriptData);
        // Num files: 386

        $dataTest = array_slice($scriptData, 0, 386);
        // dd($dataTest);

        self::generateFileClass($dataTest, $dirDestino);
        // dd($scriptData);
    }

    private static function generateFileClass($data, $dirDestino)
    {

        $myArray = [];

        foreach ($data as $row){
            $className = ucfirst($row['className']);
            $functions = $row['functions'];

            $fileName = $className.'.php';

            $content = "<?php\n\n";
            $content .= "namespace App\VB\SIGHDatos;\n\n";
            $content .= "use Illuminate\Database\Eloquent\Model;\n\n";
            $content .= "use DB;\n\n";
            $content .= "class $className extends Model\n";
            $content .= "{\n";


            // echo "<label style='color:green'>Class: $className</label><br>";
            foreach($functions as $function){

                $functionName = isset($function['name'])? $function['name']: 'Uknown';
                $functionReturn = isset($function['return'])? $function['return']: 'Uknown';
                $procedureName = isset($function['procedure']['name'])? $function['procedure']['name']: 'Uknown';
                $functionParams = $function['params'];
                $procedureParams = isset($function['procedure']['params'])? $function['procedure']['params']: [];
                $paramsF = self::writeFunctionParams($functionParams);
                $paramsP = self::writeProcedureParams($procedureParams, $functionParams);
                $paramsPR = self::writeProcedureParamsRef($procedureParams);

                $query = "\t\t\tEXEC $procedureName $paramsPR";

                // foreach($procedureParams as $procParam){
                //     // dd($procParam);
                //     $value = $procParam['type'];
                //     if (!in_array($value, $myArray))
                //     {
                //         $myArray[] = $value; 
                //     }
                // }

                // if(count($procedureParams) == 4){
                //     dd($procedureParams);
                // }
                

                $executeType = self::getExecuteType($procedureName);
                
                $queryParamsOutput = self::getQueryParaqmsOutput($procedureParams);
      
                if($queryParamsOutput['queryDeclare'] != ''){
                    $query = $queryParamsOutput['queryDeclare'] . $query;
                }

                $returnData = "\t\treturn \$data;\n";
                if($queryParamsOutput['querySelect'] != ''){
                    $query = $query . $queryParamsOutput['querySelect'];
                    $executeType = 'select'; //LA PROCEDIMIENTO MANIPULA DATOS PERO AL FINAL REALIZA UN SELECT
                    // dd($query);
                    $returnData = "\t\t\$data = reset(\$data);\n\n".$returnData;
                }

                
                // dd($executeType);

                $content .= "\tpublic function $functionName($paramsF)\n";
                $content .= "\t{\n";
                    $content .= "\t\t\$query = \"\n$query\";\n\n";
                    $content .= "$paramsP\n\n";
                    $content .= "\t\t\$data = \DB::$executeType(\$query, \$params);\n\n";
                    $content .= "$returnData";
                $content .= "\t}\n\n";

                // echo "<p style='color:blue'>$functionName</p>";
                // echo "<p style='color:orange'>".$function['paramsData']."</p>";
                // echo "<p style='color:red'>".var_dump($functionParams)."</p>";

            }
            $content .= "}";

            // dd($fileName);
            $op = Util::saveFile($dirDestino, $fileName, $content);
            if($op->status){
                echo "<p style='color:blue'>$op->message</p>";
            }else{
                echo "<p style='color:red'>$op->message</p>";
            }
            // dd($op);
            // dd($content);
        }

        // dd($myArray);
    }

    private static function getScriptArrayPHP($content)
    {
        $className = null;
        $properties = [];
        $functions = [];

        //FIND FUNCTIONS...
        $functions = [];
        $indexData = 0;
        foreach($content as $line){
            $line = trim($line);
            $wordVB_Name  = 'VB_Name';
            $wordFunction = 'Function'; $wordPublicFunction = 'Public Function';
            $wordCommandText = 'CommandText';
            $wordCreateParameter = 'CreateParameter';

            if( Util::isCommentedLine($line)) continue;


            $wordVB_NameFind = strpos($line, $wordVB_Name);
            if($wordVB_NameFind ){
                $classNamePos1 = strpos($line, '"')+1;
                $classNamePos2 = strrpos($line, '"') - $classNamePos1;
                $className = substr($line, $classNamePos1, $classNamePos2);
                // dd($className);
            }

            $wordFunctionFind = strpos($line, $wordFunction);
            $wordPublicFunctionFind = strpos($line, $wordPublicFunction);

            if($wordFunctionFind===0 or $wordPublicFunctionFind ===0){
                $indexData++;
                // dd($line);
                if($wordPublicFunctionFind===0){ //quitar palabra 'Public'
                    $newPos1 = strpos($line, ' ')+1;
                    $newPos2 = strlen($line) - $newPos1;
                    $line = substr($line, $newPos1, $newPos2);
                    // dd($line);
                }

                $namePos1 = strpos($line, ' ');
                // dd($namePos1);
                $namePos2 = strpos($line, '(')-$namePos1;
                $name = trim(substr($line, $namePos1, $namePos2));

                $paramsPos1 = strpos($line, '(')+1;
                $paramsPos2 = strpos($line, ')')-$paramsPos1;
                $params = trim(substr($line, $paramsPos1, $paramsPos2));

                $returnPos1 = strrpos($line, 'As')+2;
                $returnPos2 = strlen($line)-$returnPos1;
                $return = trim(substr($line, $returnPos1, $returnPos2));

                $functions[$indexData]['name'] = $name;
                $functions[$indexData]['params'] = self::buildFunctionParams($params);
                $functions[$indexData]['paramsData'] = $params;
                $functions[$indexData]['return'] = $return;
                $functions[$indexData]['type'] = Util::functionType($name);
            }


            $wordComandTextFind = strpos($line, $wordCommandText);
            // echo $line.'<br>';
            $procedure = [];
            if( $wordComandTextFind ){
                $procedureStar = true;
                $namePos1 = strpos($line, '"')+1;
                $namePos2 = strrpos($line, '"') - $namePos1;
                $name = substr($line, $namePos1, $namePos2);

                $functions[$indexData]['procedure']['name'] = $name;
            }

            $wordCreateParameterFind = strpos($line, $wordCreateParameter);

            if( $wordCreateParameterFind ){
                // Set parameter = command.CreateParameter (Name, Type, Direction, Size, Value)
                $paramPos1 = strpos($line, '(') + 1;
                $paramPos2 = strrpos($line, ')') - $paramPos1;
                $paramData = trim(substr($line, $paramPos1, $paramPos2));
                $paramDataArray = explode(',', $paramData);

                if(count($paramDataArray) > 5){
                    $arrayTmp = $paramDataArray;
                    $paramDataArray = array_slice($arrayTmp, 0, 4);

                    $elementFivePos1 = strpos($paramData, 'IIf');
                    $elementFivePos2 = strrpos($paramData, ')') - $elementFivePos1;
                    $elementFive = trim(substr($paramData, $elementFivePos1, $elementFivePos2+1));
                    $paramDataArray[] = $elementFive;
                }

                //formatear primera letra del parametro en minuscula
                $nameParamProcedure = isset($paramDataArray[0])? str_replace('"', '', $paramDataArray[0]): null;
                $nameParamProcedure = str_replace('@', '', $nameParamProcedure);
                $nameParamProcedure = lcfirst($nameParamProcedure);
                $nameParamProcedure = '@'.$nameParamProcedure;

                $valueParamProcedure = isset($paramDataArray[4])? trim($paramDataArray[4]): null;
                $valueParamProcedure = Util::formatValueProcedure($valueParamProcedure);

                $param['name'] = $nameParamProcedure;
                $param['type'] = isset($paramDataArray[1])? trim($paramDataArray[1]): null;
                $param['direction'] = isset($paramDataArray[2])? trim($paramDataArray[2]): null;
                $param['size'] = isset($paramDataArray[3])? trim($paramDataArray[3]): null;
                $param['value'] = $valueParamProcedure;

                // $functions[$indexData]['procedure']['params'][] = $paramDataArray;
                $functions[$indexData]['procedure']['params'][] = $param;
            }

        }

        $script['className'] = $className;
        $script['functions'] = $functions;
        // dd($script);
        return $script;
    }

    private static function buildFunctionParams($paramsData)
    {
        $paramsData = trim($paramsData);
        $paramsData = str_replace('  ', '', $paramsData);
        $paramsArray = explode(',', $paramsData);


        $params = [];
        foreach($paramsArray as $paramData){
            $paramData = trim($paramData);
            $paramData = str_replace('  ', '', $paramData);
            $paramArray = explode(' ', $paramData);

            $param = [];
            if( count($paramArray)==4 ){
                $param['pass'] = trim($paramArray[0]);
                $param['value'] = lcfirst( trim($paramArray[1]) );
                $param['type'] = trim($paramArray[3]);
            }else if (count($paramArray)==3) {
                $param['pass'] = 'ByVal';
                $param['value'] = lcfirst( trim($paramArray[0]) );
                $param['type'] = trim($paramArray[2]);
            }
            if($param) $params[] = $param ;
        }

        return $params;
    }

    // GENERA TEXTO PARA INDICAR LOS PARAMETROS DE UNA FUNCION PHP
    private static function writeFunctionParams($array)
    {
        $text = '';
        foreach($array as $row){
            $var = '$'.$row['value'];
            
            // dd($row['pass']);
            if( strcasecmp ($row['pass'], 'ByRef' ) == 0){
                $var = '&'.$var;
                // dd($var);
            }
            $text .= "$var, ";

        }
        if(count($array)) $text = substr($text, 0, strlen($text)-2);
        return $text;
    }

    // GENERA CODIGO PARA ESCRIBIR LA VARIABLE $params DE LOS PARAMETROS DE UN PROCEDIMIENTO SQL
    private static function writeProcedureParams($array, $functionParams)
    {
        $params = "\t\t\$params = [\n";
        foreach($array as $row){
            $key = $row['name'];
            $key = str_replace('@', '', $key);
            $value = self::getLogicValueParam($row['value'], $functionParams);

            // if( !is_numeric($value)){
            //     $value = str_replace('.', '->', $value);
            //     $value = "\$$value";
            // }
            $params .= "\t\t\t'$key' => $value, \n";
        }
        $params .= "\t\t];";
        return $params;
    }

    // GENERA CODIGO PARA INDICAR LOS PARAMETROS DE UN PROCEDIMIENTO SQL
    private static function writeProcedureParamsRef($array)
    {
        
        $text = '';
        foreach($array as $row){
            $key = $row['name'];
            
            if( $row['direction'] == 'adParamOutput' ){
                $key .= " OUTPUT";
            }else{
                $key = str_replace('@', ':', $key);
            }
            $text .= "$key, ";
        }
        if(count($array)) $text = substr($text, 0, strlen($text)-2);
        return $text;
    }

    private static function getLogicValueParam($text, $functionParams){
        $text = str_replace('.', '->', $text); //REMPLAZAR (.) Y (->)

        $text = $text? $text: 0;
        // $text = self::replaceVar($text, $vars);
        foreach ($functionParams as $functionParam){
            $functionVar = $functionParam['value'];
            $text = str_replace($functionVar, "\$$functionVar", $text);
        }

        $existLogic = strripos($text, 'IIf');

        if($existLogic !== false ){
            // $text = 'logic..';
            $paramsPos1 = strpos($text, '(') + 1;
            $paramsPos2 = strpos($text, '(') - $paramsPos1;
            $text = substr($text, $paramsPos1, $paramsPos2);
            $text = str_replace('=', '==', $text);
            $logicArray = explode(',', $text);
            $condition = isset($logicArray[0])? trim($logicArray[0]): false;
            $valueTrue = isset($logicArray[1])? trim($logicArray[1]): false;
            $valueFalse = isset($logicArray[2])? trim($logicArray[2]): false;

            $text = "($condition)? $valueTrue: $valueFalse";
            // dd($logicArray);
        }
        return $text;
    }

    // ANALIZAR QUE TIPO DML (RECUPERA O MANIPULA DATOS)
    private static function getExecuteType($context)
    {
        //$context = NOMBRE DEL PROCEDIMIENTO
        $wordManipulation = [
            'actualiza',
            'actualizar',
            'modificar',
            'depurar',
            'desagrega',
            'agregar',
            'eliminar',
            'add',
        ];

        foreach($wordManipulation as $wordM){
            $matchesFound = strripos($context, $wordM);
            if($matchesFound !== false){
                return 'update';
            }
        }
        return 'select';
    }

    // GENERA CODIGO PARA DECLARAR LAS VARIABLES DE SALIDA DE UN PROCEDIMIENTO
    private static function getQueryParaqmsOutput($procedureParams)
    {
        $queryDeclare = "";
        $querySelect = "";

        $once = true;
        foreach($procedureParams as $procParam){
            if($procParam['direction']=='adParamOutput'){
                if($once) {
                    $querySelect = "\n\t\t\tSELECT ";
                    $once = false;
                }
                // dd($procParam);
                // dd($procedureParams);
                $name = trim($procParam['name']);
                $nameRef = str_replace('@', ':', $name);
                $nameAs = str_replace('@', '', $name);
                $type = Util::typeAdoToSqlsvr( $procParam['type'] );
                $queryDeclare .= "\t\t\tDECLARE $name AS $type = $nameRef\n"; 
                $querySelect .= "$name AS $nameAs, ";
                
            }
        }

        if($queryDeclare != ""){
            $queryDeclare .= "\t\t\tSET NOCOUNT ON \n";
            $querySelect = substr($querySelect, 0, strlen($querySelect)-2);
            // dd($querySelect);
            // dd($queryDeclare);
        }

        $data['queryDeclare'] = $queryDeclare;
        $data['querySelect'] = $querySelect;

        // if($queryDeclare != ""){
        //     dd($data);
        // }
        return $data;
    }

}
