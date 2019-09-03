<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Developer\TraduceSighDatos;
use App\Developer\TraduceSighComun;
use App\Developer\Util;
use App\VB\SIGHDatos\LabItems;
use App\VB\SIGHDatos\LabGrupos;

class DevController extends Controller
{
    private $numFile = 0; //to generate models

    public function index()
    {
        $path = realpath(__DIR__.'\..\..\Model');
        $files = [];
        $directorio = opendir($path); //ruta actual
        // dd($directorio);
        while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
        {
            if (!is_dir($archivo)  && substr($archivo,-4)=='.php' )//verificamos si es o no un directorio
            {
                $files[] = substr($archivo, 0 ,strlen($archivo)-4);
            }
        }
        return view('dev.index', compact('files'));
    }

    public function procedures()
    {
        $procedures = [];
        $filePath = realpath(__DIR__.'\..\..\Visual\Procedure.php');
        $file = fopen($filePath, 'r');
        while( $line = fgets($file)){
            $nameFuntion = $this->getStringBetween($line, 'function', '(');
            if($nameFuntion){
                $procedures[] = $nameFuntion;
            }
        }
        fclose($file);

        dd($procedures);
    }

    function getStringBetween($string, $start, $end){
        $string = " ".$string;
        $ini = strpos($string,$start);
        if ($ini == 0) return "";
        $ini += strlen($start);   
        $len = strpos($string,$end,$ini) - $ini;
        return substr($string,$ini,$len);
    }

    public function design($file)
    {
        $file = $file;
        $table = \DB::table("$file")->get()->first();
        $colums = [];
        foreach($table as $key => $row)
        {
            $colums[] = $key;
        }

        return view('dev.partials.design', compact('file','colums'));
    }

    public function list($file)
    {
        $file = $file;
        $rows = \DB::table("$file")->paginate(10);
        $table = $rows->first();
        $cols = [];
        foreach($table as $key => $row)
        {
            $cols[] = $key;
        }
        return view('dev.partials.list', compact('file','cols', 'rows'));
    }

    public function createModel(Request $request)
    {
        $tableName = $request->tableName;
        $tablas = DB::select(
            "SELECT CAST(table_name as varchar) nombre
            FROM INFORMATION_SCHEMA.TABLES
            WHERE table_name = '$tableName'");

        if(count($tablas)){
            foreach($tablas as $tabla){
                $this->buildFile($tabla->nombre);
            }
        }else{
            echo "<label style='color:red'> Not found table in database</label>";
        }
    }

    private function buildFile($tableName)
    {
        $this->numFile++;

        $sqlCols = "SELECT c.name
        FROM sys.columns c JOIN sys.tables t 
        ON c.object_id = t.object_id
        WHERE t.name = '$tableName'";

        $cols = DB::select($sqlCols);

        $tableNameUC = ucfirst($tableName);
        $fileName = "DO$tableNameUC";
        $pathFile = "../app/Visual/SIGHComun/$fileName.php";

        $script  = "<?php \n";
        $script .= "// GENERATED AT: ".date('d-m-Y h:i:s A')."\n";
        $script .= "// AUTHOR: Romel\n";
        $script .= "namespace App\Visual\SIGHComun; \n\n";
        $script .= "use App\BaseModel; \n\n";
        $script .= "use DB; \n\n";
        $script .= "class $fileName extends BaseModel\n";
        $script .= "{\n";
            $script .= "\tprotected \$table = '$tableName';\n\n"; 
            $script .= "\tprotected \$fillable = [";

            foreach($cols as $col)
                $script .= "\n\t\t'$col->name',";
            $script .= "\n\t];\n\n";

            

            $script .= "\t// MUTATORS AND ACCESESORS\n";
            foreach($cols as $col){
                $script .= "\n\tpublic function get".ucfirst($col->name)."Attribute() ";
                $script .= "\n\t{";
                    $script .= "\n\t\treturn isset(\$this->attributes['$col->name'])? \$this->attributes['$col->name']: null;";
                $script .= "\n\t}";

                $script .= "\n\tpublic function set".ucfirst($col->name)."Attribute( \$value ) ";
                $script .= "\n\t{";
                    $script .= "\n\t\t\$this->attributes['$col->name'] = \$value;";
                $script .= "\n\t}\n";

            }
                

        $script .= "}";

        if($file = fopen($pathFile, "w"))
        {
            if(fwrite($file, $script))
            {
                echo "<label style='color:green'>$this->numFile: \t$fileName.php Created! </label></br>";
            }
            else
            {
                echo "<label style='color:red'>$this->numFile: \t$fileName.php Fail! </label></br>";
            }
            fclose($file);
        }
    }

    // Generate SIGHDatos folder and files
    public function generaSighDatos()
    {
        $dirOrigen = realpath('C:\SISGALEN_MIGRAR\CODIGO\SIGHDatos');
        $dirDestino = realpath('C:\xampp\htdocs\galenz\app\VB\SIGHDatos');
        TraduceSighDatos::generaClases($dirOrigen, $dirDestino);
    }

    // Generate SIGHComun folder and files
    public function generaSighComun()
    {
        $dirOrigen = realpath('C:\SISGALEN_MIGRAR\CODIGO\SIGHComun');
        $dirDestino = realpath('C:\xampp\htdocs\galenz\app\VB\SIGHComun');
        TraduceSighComun::generaClases($dirOrigen, $dirDestino);
    }

    public function test()
    {
        $reglasSeguridad = new \App\VB\SIGHNegocios\ReglasDeSeguridad;
        dd($reglasSeguridad->RolesSeleccionarTodos());
    }

    //Generate: controllers, routes, views, view-partials, js
    public function generateControllers() 
    {
        $data = DB::table('ListBarItems as i')
            ->leftJoin('ListBarGrupos as g', 'i.IdListGrupo', 'g.IdListGrupo')
            ->select('g.IdListGrupo as grupoId', 'g.controller as grupoController'
                , 'g.Texto as grupoNombre', 'g.Clave as grupoClave', 'g.indice as grupoIndice'
                ,'i.IdListItem as itemId', 'i.controller as itemController', 'i.Texto as itemNombre'
                , 'i.Clave as itemClave', 'i.Indice as itemIndice', 'i.KeyIcon as itemKeyIcon', 'i.iconWeb as itemIcon')
            ->get();

        // dd($data); 
        $carpetas = [];
        foreach($data as $row)
        {
            $carpetas[$row->grupoClave]['id'] = $row->grupoId;
            $carpetas[$row->grupoClave]['clave'] = $row->grupoClave;
            $carpetas[$row->grupoClave]['nombre'] = $row->grupoNombre;
            $carpetas[$row->grupoClave]['controller'] = $row->grupoController;
            $carpetas[$row->grupoClave]['indice'] = $row->grupoIndice;
            $carpetas[$row->grupoClave]['archivos'][] = [
                'id' => $row->itemId,
                'clave' => $row->itemClave,
                'nombre' => $row->itemNombre,
                'controller' => $row->itemController,
                'indice' => $row->itemIndice,
                'icon' => $row->itemIcon,
            ];
        }
        $carpetas = json_decode(json_encode($carpetas));
        // dd($carpetas);
        foreach($carpetas as $carpeta){
            // $this->generarteScriptJS($carpeta);
            // $this->generateScriptController($carpeta);
            // $this->generateScriptRoute($carpeta);
            // $this->generateScriptView($carpeta);
        }
        
    }

    private function generarteScriptJS($carpeta)
    {
        $rutaModulo = __DIR__.'/../../../public/js/'.camelToMiddledash($carpeta->controller);
        $this->createFolder($rutaModulo);
        $archivos = $carpeta->archivos;
        $contentLayout = $this->getFileLayoutContent('model.js');

        foreach($archivos as $archivo){
            $content = $contentLayout;
            $content = str_replace('InputNameModel', lcfirst($archivo->controller), $content);
            $nameFile = camelToMiddledash($archivo->controller).'.js';

            $result = $this->saveFile($rutaModulo, $nameFile, $content);
            if($result->status){
                echo "<span style='color:DARKORANGE'>$result->message</span><br>";
            }else{
                echo "<span style='color:RED'>$result->message</span><br>";
            }
        }
    }

    private function generateScriptController($carpeta)
    {
        $rutaModulo = __DIR__.'/../../../app/Http/Controllers/'.$carpeta->controller;
        $rutaModulo = $this->createFolder($rutaModulo);
        $archivos = $carpeta->archivos;
        $contentLayout = $this->getFileLayoutContent('controller.php');

        foreach($archivos as $archivo){
            $content = $contentLayout;
    
            $content = str_replace('InpuNameSpace', $carpeta->controller, $content);
            $content = str_replace('InpuNameController', $archivo->controller.'Controller', $content);
            $content = str_replace('InputNameModulo', camelToMiddledash($carpeta->controller), $content);
            $content = str_replace('InputNameSubModulo', camelToMiddledash($archivo->controller), $content);

            $nombreArchivo = $archivo->controller.'Controller.php';

            $result = $this->saveFile($rutaModulo, $nombreArchivo, $content);
            if($result->status){
                echo "<span style='color:green'>$result->message</span><br>";
            }else{
                echo "<span style='color:red'>$result->message</span><br>";
            }
        }
    }

    private function generateScriptRoute($carpeta)
    {
        $rutaModulo = __DIR__.'/../../../routes/partials';
        $rutaModulo = $this->createFolder($rutaModulo);
        $archivos = $carpeta->archivos;
        $content = $this->getFileLayoutContent('route.php');

        $codeLoop = '';
        foreach( $archivos as $archivo){
            $nombreRecurso = camelToMiddledash($archivo->controller);
            $codeLoop .= "\t\tRoute::resource('/$nombreRecurso', '$carpeta->controller\\".$archivo->controller."Controller');\n";
            $codeLoop .= "\t\tRoute::get('/$nombreRecurso/{id}/delete', '$carpeta->controller\\".$archivo->controller."Controller@delete');\n";
            $codeLoop .= "\t\tRoute::get('/$nombreRecurso/api/service', '$carpeta->controller\\".$archivo->controller."Controller@apiService');\n\n";
        }

        $nameController = camelToMiddledash($carpeta->controller);
        $content = str_replace('InputNamePrefix', $nameController, $content);
        $content = str_replace('InputNameName', $nameController, $content);
        $content = str_replace('//codeLoop', $codeLoop, $content);

        $nombreArchivo = $carpeta->controller.'Route.php';

        $result = $this->saveFile($rutaModulo, $nombreArchivo, $content);

        if($result->status){
            echo "<span style='color:blue'>$result->message</span><br>";
        }else{
            echo "<span style='color:red'>$result->message</span><br>";
        }

    }

    private function generateScriptView($carpeta)
    {
        $rutaModulo = __DIR__.'/../../../resources/views/'.camelToMiddledash($carpeta->controller);
        $rutaModulo = $this->createFolder($rutaModulo);
        $archivos = $carpeta->archivos;
        $contentLayout = $this->getFileLayoutContent('index.blade.php');

        foreach($archivos as $archivo){
            
            $content = $contentLayout;
    
            $content = str_replace('InputNameModulo', $carpeta->nombre, $content);
            $content = str_replace('InputNameSubModulo', $archivo->nombre, $content);
            $content = str_replace('InputKeyModulo', $carpeta->clave, $content);
            $content = str_replace('InputKeySubModulo', $archivo->clave, $content);
            
            $content = str_replace('InputNameIcon', $archivo->icon, $content);

            $content = str_replace('InputNameModel', lcfirst($archivo->controller), $content);

            
            $content = str_replace('InputNameRoute', camelToMiddledash($carpeta->controller), $content);
            $content = str_replace('InputNameSubRoute', camelToMiddledash($archivo->controller), $content);
            
            $nombreArchivo = 'index.blade.php';

            $rutaSubModulo = $rutaModulo.'\\'.camelToMiddledash($archivo->controller);

            $rutaSubModulo = $this->createFolder($rutaSubModulo);

            $this->generateScriptViewPartials($rutaSubModulo, $carpeta->controller, $archivo);

            $result = $this->saveFile($rutaSubModulo, $nombreArchivo, $content);
            if($result->status){
                echo "<span style='color:green'>$result->message</span><br>";
            }else{
                echo "<span style='color:red'>$result->message</span><br>";
            }
            // dd('ok');
        }

    }

    private function generateScriptViewPartials($rutaSubModulo, $carpetaController, $archivo)
    {
        $rutaPartials = $rutaSubModulo.'\\partials';
        $rutaPartials = $this->createFolder($rutaPartials);

        //item-list
        $content = $this->getFileLayoutContent('item-list.blade.php');
        $content = str_replace('InputNameModel', lcfirst($archivo->controller), $content);

        $nombreArchivo = 'item-list.blade.php';

        $result = $this->saveFile($rutaPartials, $nombreArchivo, $content);
        if($result->status){
            echo "<span style='color:green'>$result->message</span><br>";
        }else{
            echo "<span style='color:red'>$result->message</span><br>";
        }

        //item-create
        $content = $this->getFileLayoutContent('item-create.blade.php');
        $content = str_replace('InputNameModel', lcfirst($archivo->controller), $content);
        $content = str_replace('InputNameRoute', camelToMiddledash($carpetaController), $content);
        $content = str_replace('InputNameSubRoute', camelToMiddledash($archivo->controller), $content);

        $nombreArchivo = 'item-create.blade.php';

        $result = $this->saveFile($rutaPartials, $nombreArchivo, $content);
        if($result->status){
            echo "<span style='color:green'>$result->message</span><br>";
        }else{
            echo "<span style='color:red'>$result->message</span><br>";
        }

        //item-edit
        $content = $this->getFileLayoutContent('item-edit.blade.php');
        $content = str_replace('InputNameModel', lcfirst($archivo->controller), $content);
        $content = str_replace('InputNameRoute', camelToMiddledash($carpetaController), $content);
        $content = str_replace('InputNameSubRoute', camelToMiddledash($archivo->controller), $content);

        $nombreArchivo = 'item-edit.blade.php';

        $result = $this->saveFile($rutaPartials, $nombreArchivo, $content);
        if($result->status){
            echo "<span style='color:green'>$result->message</span><br>";
        }else{
            echo "<span style='color:red'>$result->message</span><br>";
        }

        //item-delete
        $content = $this->getFileLayoutContent('item-delete.blade.php');
        $content = str_replace('InputNameModel', lcfirst($archivo->controller), $content);
        $content = str_replace('InputNameRoute', camelToMiddledash($carpetaController), $content);
        $content = str_replace('InputNameSubRoute', camelToMiddledash($archivo->controller), $content);

        $nombreArchivo = 'item-delete.blade.php';

        $result = $this->saveFile($rutaPartials, $nombreArchivo, $content);
        if($result->status){
            echo "<span style='color:green'>$result->message</span><br>";
        }else{
            echo "<span style='color:red'>$result->message</span><br>";
        }

    }

    private function createFolder($pathFile){
        if (!file_exists($pathFile)) mkdir($pathFile, 0777, true);
        return realpath($pathFile);
    }

    private function saveFile($basePath, $fileName, $content)
    {
        $basePath = realpath($basePath);
        $response['status'] = false;
        $response['message'] = 'Uknown';
        $response = json_decode(json_encode($response));

        try{
            if (!file_exists($basePath)) mkdir($basePath, 0777, true);
        
            $filePath = $basePath.'\\'.$fileName;

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

    private function getFileLayoutContent($nameFile)
    {
        
        $pathFile = realpath(__DIR__.'/../../../0layouts_scripts/'.$nameFile);

        $file = $pathFile? file_get_contents($pathFile): null;
        return $file;
        
    }
}
