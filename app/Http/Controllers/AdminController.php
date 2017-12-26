<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use \Response;
use App\Product;
use App\Pin;

class AdminController extends Controller
{
    public function index()
    {
    	return view('admin.index');
    }

    public function pin()
    {
    	return view('admin.pin');
    }

    public function producto()
    {
    	return view('admin.producto');
    }

    public function informacion()
    {
        return view('admin.informacion');
    }

    public function idProducto(Request $request)
    {
        $id = $_POST['id'];
        $request->session()->put('idProducto', $id);

        return Response::json(array('html' => 'ok'));
    }

    public function generarPines(Request $request)
    {	
    	$html = "";
		$html2 = "";
    	$cont = 0;
    	$columns = 10;
		$data = array();
		$arrayPins = array();
    	$booleanProduct = False;
    	$booleanPin = False;
		$number = $_POST['number'];
    	$name = $_POST['name'];
    	$description = $_POST['description'];

    	$products = Product::where('name', $name)
    						->get();
    	foreach ($products as $product)
    	{
    		$booleanProduct = True;
    	}

    	if ($booleanProduct == False) {

    		$create_product = new Product;
    		$create_product->name = $name;
    		$create_product->description = $description;
    		$create_product->user_id = Auth::user()->id;
    		$create_product->save();

    		$products = Product::orderBy('id', 'desc')
                                ->limit(1)
                                ->get();
            foreach ($products as $product)
            {
            	$id = $product->id;
            }

			for ($i = 1; $i <= $number; $i++)
			{
				$booleanPin = False;

				$str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$shuffled = str_shuffle($str);
				$letter = substr($shuffled, 0, 4);

				$randval = mt_rand();
				$random = substr($randval, 0, 4);

				$pin = $letter.$random;

				$clave = array_search($pin, $arrayPins);		

				$pins = Pin::where('pin', $pin)
							->get();
				foreach ($pins as $pin)
				{
					$booleanPin = True;
				}	

				if ($clave === False && $booleanPin == False) {
					array_push($arrayPins, $pin);
					$data[]= array('pin' => $pin, 'product_id' => $id);
				} else {
					$i = $i - 1;
				}	
			}

			$html .= "<table class='table table-bordered'>
	                <thead class='thead-s'>
	                <tr>";

	        for ($i = 0; $i < $columns; $i++)
	        {
	        	$n = $i+1;
	        	$html .= "<th class='text-center'>Columna $n</th>";
	        }
	       
	        $html .= "</tr>
	                </thead>
	                <tbody>";

	        $html .="<tr class='border-dotted'>";

	        foreach ($arrayPins as $arrayPin) {
	        	$cont++;

	        	$html .= "<td class='text-center'>$arrayPin</td>";

	            if ($cont == $columns) {
	            	$cont = 0;
	            	$html .= "</tr>";
	            	$html .= "<tr class='border-dotted'>";
	            }           
	        };

	        $html .= "</tr>";

	        $html .= "</tbody>
	                </table>";

        	Pin::insert($data);

            $html2 = "Se han generado los numeros con éxito";
    	}else{
    		$html2 = "Ya existe ese título, por favor intente con otro";
    	}

		return Response::json(array('html' => $html, 'pin' => $html2,));
    }

    public function mostrarTablaProductos(Request $request)
    {
    	$html = "";
    	$cont = 0;
        $booleanProduct = False;    	

    	$html .= "<table class='table table-bordered'>
                <thead class='thead-s'>
                <tr>";

        $html .= "<th class='text-center'>Numero</th>";
        $html .= "<th class='text-center'>Nombre</th>";
        $html .= "<th class='text-center'>Funciones</th>";

        $html .= "</tr>
                </thead>
                <tbody>";

        $products = Product::all();
    	foreach ($products as $product)
    	{
            $cont++;
            $booleanProduct = True;
    		$id = $product->id;
    		$name = $product->name;

    		$html .= "<tr class='border-dotted'>";
    		$html .= "<td class='text-center'>$cont</td>";
    		$html .= "<td class='text-center'>$name</td>";
    		$html .= "<td class='text-center' style='width: 50%;'>";
    		$html .= "<a id='$id' href='#' class='btn btn-info' value='actualizar' data-toggle='modal' data-target='#modalActualizarProducto' style='margin-right: 1%;'>Editar</a>";
    		$html .= "<a id='$id' href='#' class='btn btn-danger' value='eliminar' data-toggle='modal' data-target='#modalEliminarProducto' style='margin-right: 1%;'>Eliminar</a>";
            $html .= "<a id='$id' href='#' class='btn btn-primary' value='informacion' style='margin-right: 1%;'>Información</a>";
    		$html .= "</td>";
    		$html .= "</tr>";
    	}

    	$html .= "</tbody>
                </table>";

        if ($booleanProduct == False) {
            $html = "<h1 class='text-center'>No hay categorías que mostrar</h1>";
        }

        return Response::json(array('html' => $html,));
    }

    public function mostrarActualizarProducto(Request $request)
    {
    	$id = $_POST['id'];

    	$products = Product::where('id', $id)
    						->get();
    	foreach ($products as $product)
    	{
            $name = $product->name;
    		$description = $product->description;
    	}

    	return Response::json(array('name' => $name, 'description' => $description));    	
    }

    public function actualizarProducto(Request $request)
    {
    	$html = "";
    	$booleanProduct = False;
    	$id = $_POST['id'];
        $name = $_POST['name'];
    	$description = $_POST['description'];

    	$products = Product::where('name', $name)
                            ->where('description', $description)
    						->get();
    	foreach ($products as $product)
    	{
    		$booleanProduct = True;
    	}

    	if ($booleanProduct == False) {
    		$update_product = Product::find($id);
            $update_product->name = $name;
            $update_product->description = $description;
            $update_product->save();
			$html = "Se ha actualizado con éxito";
    	} else {
    		$html = "No se puede actualizar, ya hay un producto con ese nombre";
    	}

    	return Response::json(array('html' => $html,));    	
    }

    public function eliminarProducto(Request $request)
    {
    	$html = "";
    	$id = $_POST['id'];

    	$pins = Pin::where('product_id', $id)
    				->get();
    	foreach ($pins as $pin)
    	{
    		$idPin = $pin->id;
    		$delete_pin = Pin::find($idPin);
    		$delete_pin->delete();
    	}

		$delete_product = Product::find($id);
        $delete_product->delete();
		$html = "Se ha eliminado con éxito";

    	return Response::json(array('html' => $html,));    	
    }

    public function mostrarTablaInformacion(Request $request)
    {   
        $html = "";
        $columnas = 10;
        $cont = 0;
        $idProducto = null;

        if($request->session()->get("idProducto")){
            $idProducto = $request->session()->get("idProducto");
        }

        if($idProducto != null){
                   
            $html .= "<table class='table table-bordered'>
                    <thead class='thead-s'>
                    <tr>";

            for ($i = 0; $i < $columnas; $i++) {
                $n = $i+1;
                $html .= "<th class='text-center'>Columna $n</th>";
            }
           
            $html .= "</tr>
                    </thead>
                    <tbody>";

            $pins = Pin::where('product_id', $idProducto)
                            ->get();   
            foreach ($pins as $pin) {
                $cont++;
                $id = $pin->id;
                $status = $pin->status;
                $pin = $pin->pin;

                if($status == "Verdadero"){
                    $html .= "<td id='$id' data-toggle='modal' data-target='#modalInformacion' style='background-color: #2A9C37; color: #FFFFFF;' class='text-center'>$pin</td>";
                }else{
                    $html .= "<td id='$id' data-toggle='modal' data-target='#modalInformacion' class='text-center'>$pin</td>";
                }

                if($cont == $columnas){
                    $cont = 0;
                    $html .= "</tr>";
                    $html .= "<tr class='border-dotted'>";
                }           
            }

            $html .= "</tr>";

            $html .= "</tbody>
                    </table>";

        }
        
        return Response::json(array('html' => $html,));
    }

    public function mostrarInformacionDelPin(Request $request)
    {
        $id = $_POST['id'];
        $html = "";

        $pins = Pin::where('id', $id)
                            ->get();
        foreach ($pins as $pin) {
            $idUsuario = $pin->user_id;
            $status = $pin->status;      
            $pin = $pin->pin;      
        }

        if($status == "Verdadero"){

            $users = User::where('id', $idUsuario)
                            ->get();

            foreach ($users as $user) {
                $name = $user->name;    
            }

            $html = "<h2 class='text-center'>El usuario $name uso el pin: $pin</h2>";
        }else{
            $html = "<h2 class='text-center'>El pin $pin esta disponible</h2>";
        }
  
        return Response::json(array('html' => $html));
    }
}
