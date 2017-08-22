<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laboratorio extends CI_Controller {
   
    public function __construct()
    {
	    parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->model('laboratorio_model');
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');     		
    }
	
	public function index()
	{	

		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{
				
			$data['title'] = "Lista de Actas";	
			$data['content'] = "lista";
			//$data['actas'] =  $this->laboratorio_model->actas();
			//Styled Data
			$data['js_files'] = array("0"=>"js/modules/laboratorio/lista");	
			//$data['css_files'] = array();	
			//Model Data
			//$data["third"] = $this->register_model->third();
			//Session Data		
			$data['session'] = $this->session->userdata('data');
			$this->load->view('templates/v1/template_v1', $data);
		}
	}
	

	public function muestra(){
		
		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{
				
			$data['title'] = "Lista de Muestras";	
			$data['content'] = "lista_muestras";
			//$data['actas'] =  $this->laboratorio_model->actas();
			//Styled Data
			$data['js_files'] = array("0"=>"js/modules/laboratorio/lista_muestras");	
			//$data['css_files'] = array();	
			//Model Data
			//$data["third"] = $this->register_model->third();
			//Session Data		
			$data['session'] = $this->session->userdata('data');
			$this->load->view('templates/v1/template_v1', $data);
		}
	}

	public function historico()
	{	

		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{
				
			$data['title'] = "Lista Historico de Actas";	
			$data['content'] = "lista";
			//$data['actas'] =  $this->laboratorio_model->actas();
			//Styled Data
			$data['js_files'] = array("0"=>"js/modules/laboratorio/historico");	
			//$data['css_files'] = array();	
			//Model Data
			//$data["third"] = $this->register_model->third();
			//Session Data		
			$data['session'] = $this->session->userdata('data');
			$this->load->view('templates/v1/template_v1', $data);
		}
	}
	
	
	
	public function _example_output($output = null)
	{		
		$this->load->view('templates/v1/GC_template_v1.php',$output);
	}
	
	public function creacion()
	{					
		
		$data['title'] = "Lista de Actas";	
		$data['content'] = "creacion";
		$data["terceros"] = $this->laboratorio_model->terceros();
		$data["sucursales"] = $this->laboratorio_model->sucursales();
		//Styled Data
		$data['js_files'] = array("0"=>"js/modules/compras/creacion");	
		//$data['css_files'] = array();	
		//Model Data
		
		//Session Data		
		$data['session'] = $this->session->userdata('data');
		$this->load->view('templates/v1/template_v1', $data);
	}


	public function cargaBarras(){

		$id = $_POST["id"];

		echo json_encode($this->laboratorio_model->cargaBarras($id));
	}

	public function loadMuestras(){
		
		echo json_encode($this->laboratorio_model->loadMuestras());
	}

	public function reloadData(){

		echo json_encode($this->laboratorio_model->reloadData());
	}

	public function reloadDataHistory(){

		echo json_encode($this->laboratorio_model->reloadDataHistory());
	}

	public function loadActa(){

		echo json_encode($this->laboratorio_model->loadActa($_POST["id"]));
	}

	public function loadAnalisis(){

		echo json_encode($this->laboratorio_model->loadAnalisis($_POST["id"]));
	}


	public function ajaxLoadBarras(){	

		//die(print_r($this->session->userdata('barras')));

		if($this->session->userdata('barras')){

			echo  json_encode(array("error"=>0, "data"=>$this->session->userdata('barras')));

		}else{

			echo json_encode(array("error"=>1, "data"=>"Sin informacion"));
		}
	}


	public function addBarra(){

		$data = $_POST;

		$dataBarra = $this->laboratorio_model->loadBarra($data["id"]);

		if($this->session->userdata('barras')){

			$barras = $this->session->userdata('barras');
		
			if($this->searchForId($data["id"], $barras) != false){

				echo  json_encode(array("error"=>1, "data"=>"Ya existe este material en la lista."));

			}else{

				$newdata = array('idBarra'     => $dataBarra["id"],
								 'descripcion' => $dataBarra["descripcion"],
								 'peso'        => $dataBarra["peso"],
								 'peso_humedo' => $dataBarra["peso_humedo"],
								 'sucursal'    => $dataBarra["sucursal"]
				);

				array_push($barras, $newdata);

				$this->session->set_userdata('barras', $barras);

				echo  json_encode(array("error"=>0, "data"=>"Se agrego material correctamente."));
			}

		}else{
			
				$newdata = array( 0 => array('idBarra'     => $dataBarra["id"],
											 'descripcion' => $dataBarra["descripcion"],
											 'peso'        => $dataBarra["peso"],
											 'peso_humedo' => $dataBarra["peso_humedo"],
											 'sucursal'    => $dataBarra["sucursal"]
											)
				);

				$this->session->set_userdata('barras', $newdata);	

				echo  json_encode(array("error"=>0, "data"=>"Se agrego material correctamente."));
		}
	}	


	public function delBarra(){

		$data = $_POST;

		if($this->session->userdata('barras')){

			$barras = $this->session->userdata('barras');

			$this->session->set_userdata('barras', array());

			foreach($barras as $key => $row){

				if($row["idBarra"] == $data["id"]){

					unset($barras[$key]);	
				}
			}		
			
			$this->session->set_userdata('barras', $barras);

			echo  json_encode(array("error"=>0, "data"=>"Se agrego material correctamente."));			
		}
	}	
	

	public function searchForId($id, $array) {

		foreach ($array as $key => $val) {

			if ($val['idBarra'] === $id) {
				
				return true;
			}
		}
		
		return false;	
	}
	
	
	public function guardar(){

		$data = $_POST;
		$material = $this->session->userdata('barras');
		$usuario = $this->session->userdata('data');
        $idUsuario = $usuario['id_usuario'];	

		$a_dataCab = array("fecha"=>date("Y-m-d h:i:s"),
						   "lugar"=>"Medellin",
						   "idUsuario" => $idUsuario,
						   "idSucursal"=>$data["idSucursal"],
						   "idTercero"=>$data["idTercero"],
						   "ip"=>$_SERVER["REMOTE_ADDR"],
						   "estado"=>"A");

		$a_validaMaterial = $this->validaMaterial($material);

		if($a_validaMaterial != false){

			$this->session->set_flashdata("msg",$a_validaMaterial);			
			redirect(base_url()."compras/creacion");

		}else{

			$b_resSave = $this->laboratorio_model->save($a_dataCab, $material);	

			if($b_resSave != false){

				$this->session->set_userdata('barras', array());
				$this->session->set_flashdata("msg","Se creo un nuevo acta de ingreso satisfactoriamente.");
				$this->session->set_flashdata("recent", $b_resSave);			
				redirect(base_url()."compras/recepcion");

			}else{

				$this->session->set_flashdata("msg","Problemas al generar el acta de ingreso, valide la información e intente de nuevo.");			
				redirect(base_url()."compras/creacion");
			}
		}
	}


	private function validaMaterial($data){

		$a_res = "";
		$a_cant = 0;

		foreach($data as $key){

			$res =  $this->laboratorio_model->validaMaterial($key["idBarra"]);

			if($res == true){

				$a_res .= "<li>".$key["descripcion"]." - Peso: ".$key["peso"]." Grs"."</li>";

				$a_cant++;
			}			
		}

		if($a_cant > 0){

			return "<p>El siguiente material ya se encuentra registrado y no se puede ingresar de nuevo.</p><ol>".$a_res."</ol>";

		}else{
			
			return false;
		}		
		
	}

	public function pdfExport($sha){

		if($sha == ""){

			redirect(base_url()."compras/recepcion");
		}	

		$b_veriSha = $this->laboratorio_model->veriSha($sha);

		if($b_veriSha == false){

			$this->session->set_flashdata("msg","El documento solicitado no existe.");
			redirect(base_url()."compras/recepcion");
		}

		$this->load->library('pdf');	
		$ruta = "private/actas/".hash("sha256",date("Ymdhis"));

		$content = file_get_contents("formats/operaciones/FTLO02/ftlo02.php"); 

		ob_start();
		echo $content;
		$html = ob_get_contents();
		ob_clean();

		$pdf = $this->pdf->create($html, $ruta, "P");

	}	


	public function receiveMaterial(){

		$idActa = $_POST["id"];	
		$usuario = $this->session->userdata('data');		
        $idUsuario = $usuario['id_usuario'];	

		$a_dataCab = array("fechaRecepcion"  => date("Y-m-d h:i:s"),
						   "idUsuarioRecibe" => $idUsuario
					      );

		$a_resReceiveMaterial = $this->laboratorio_model->receiveMaterial($a_dataCab, $idActa);

		if($a_resReceiveMaterial != false){

			echo json_encode(array("type"=>"Satisfactorio!",
								   "mns"=>"Se ha recibido la mercancia correctamente."));

		}else{

			echo json_encode(array("type"=>"Error",
								   "mns"=>"Problemas al recibir la mercancia."));
		}
	}
	
	public function loadBarras(){

		$idActa = $_POST["id"];	
				
		$a_resReceiveMaterial = $this->laboratorio_model->loadBarras($idActa);

		if($a_resReceiveMaterial != false){

			echo json_encode($a_resReceiveMaterial);

		}else{

			echo json_encode(array("error"=>"1", "mns"=>"Problemas al cargar las barras."));
		}
	}


	public function saveAnalisis(){

		$data = $_POST;	
		$usuario = $this->session->userdata('data');		
        $idUsuario = $usuario['id_usuario'];	
		$tipo = "";
		$result = false;
		$a_data = array();
		$a_dataTemp = array();

		switch($data["anType"]){


			case "muestra":
			
			for($x=0; $x<count($data["idBarra"]);$x++){

				$a_dataTemp = array("idActa"=>$data["id"],
									"idBarra"=>$data["idBarra"][$x],									
									"peso"=>$data["peso_mu"][$x],								
									"fecha"=>date("Y-m-d h:i:s"),
									"idUsuario"=>$idUsuario);

				array_push($a_data, $a_dataTemp);					  
			}
				
			$result = $this->laboratorio_model->saveMuestra($a_data);
			
			break;

			case "D":
				
				$tipo = "Densidad";

				for($x=0; $x<count($data["idBarra"]);$x++){

					$f_resDen = $data["peso"][$x] - $data["peso_humedo"][$x];
					$f_densidad = $data["peso"][$x] / $f_resDen;
					$f_leyDen = (23.03 / $f_densidad-2.1912) / -1 ;
					$f_finosDen = ($data["peso"][$x] * $f_leyDen) * +1;

					$a_dataTemp = array("idActa"=>$data["id"],
										"idBarra"=>$data["idBarra"][$x],
										"tipo"=>$tipo,
										"peso"=>$data["peso"][$x],
										"peso_humedo"=>$data["peso_humedo"][$x],
										"res_den"=>$f_resDen,
										"densidad"=>$f_densidad,
										"ley_den"=>$f_leyDen,
										"finos_den"=>$f_finosDen,
										"fecha"=>date("Y-m-d h:i:s"),
										"idUsuario"=>$idUsuario);

					array_push($a_data, $a_dataTemp);					  
				}
					
				$result = $this->laboratorio_model->saveLaboratorio($data["id"], $a_data, $data["anType"]);
				
				break;

			case "RFX":

				$tipo = "RFX";			

				for($x=0; $x<count($data["idBarra"]);$x++){

					$f_finosRx = $data["peso"][$x] * $data["ley_rx"][$x];
				
					$a_dataTemp = array("idActa"=>$data["id"],
										"idBarra"=>$data["idBarra"][$x],
										"tipo"=>$tipo,
										"peso"=>$data["peso"][$x],										
										"ley_rx"=>$data["ley_rx"][$x],
										"finos_rx"=>$f_finosRx,
										"fecha"=>date("Y-m-d h:i:s"),
										"idUsuario"=>$idUsuario);
					
					array_push($a_data, $a_dataTemp);					  
				}

				$result = $this->laboratorio_model->saveLaboratorio($data["id"], $a_data, $data["anType"]);
	
				break;

			case "C":

				$tipo = "Copelacion";

				for($x=0; $x<count($data["idBarra"]);$x++){

					$i_leyCopela = $data["ley_au"][$x] - 0.002;
					$i_finosAg = $data["peso"][$x] * $data["ley_ag"][$x];
					$i_finosAu = $data["peso"][$x] * $i_leyCopela;
				
					$a_dataTemp = array("idActa"=>$data["id"],
										"idBarra"=>$data["idBarra"][$x],
										"tipo"=>$tipo,
										"peso"=>$data["peso"][$x],										
										"ley_copela"=>$i_leyCopela,
										"ley_au"=>$data["ley_au"][$x],
										"ley_ag"=>$data["ley_ag"][$x],
										"finos_au"=>$i_finosAu,
										"finos_ag"=>$i_finosAg,
										"fecha"=>date("Y-m-d h:i:s"),
										"idUsuario"=>$idUsuario);
				
					array_push($a_data, $a_dataTemp);					  
				}

				$result = $this->laboratorio_model->saveLaboratorio($data["id"], $a_data, $data["anType"]);

				break;
		}	

		//Mensaje en caso de ser una toma de muestra.
		if($data["anType"] == "muestra"){

			if($result == true){
				
				echo json_encode(array("type"=>"Satisfactorio!","mns"=>"Se tomo la muestra correctamente."));
	
			}else{
	
				echo json_encode(array("type"=>"Error","mns"=>"Problemas al registrar la muestra."));
			}

		}else{

		//Mensaje en caso de ser un registro de analisis.
			if($result == true){

				echo json_encode(array("type"=>"Satisfactorio!","mns"=>"Se registrado el analisis correctamente."));

			}else{

				echo json_encode(array("type"=>"Error","mns"=>"Problemas al registrar el analisis."));
			}
		}
	}


	public function validaBarra($idBarra, $idActa){

		return $this->laboratorio_model->validaBarra($idBarra, $idActa);
	}


	public function cancel(){

		$id = $_POST["id"];
	
		$result =  $this->laboratorio_model->cancel($id);

		if($result == true){

			echo json_encode(array("estado"=>"success","type"=>"Satisfactorio!","mns"=>"Se registrado el analisis correctamente."));

		}else{

			echo json_encode(array("estado"=>"error","type"=>"Error","mns"=>"Problemas al registrar el analisis."));
		}
	}


	public function finish(){

		$id = $_POST["id"];
	
		$result =  $this->laboratorio_model->finish($id);

		if($result == true){

			echo json_encode(array("estado"=>"success","type"=>"Satisfactorio!","mns"=>"Se registrado el analisis correctamente."));

		}else{

			echo json_encode(array("estado"=>"error","type"=>"Error","mns"=>"Problemas al registrar el analisis."));
		}
	}

}
