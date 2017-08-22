<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filemanager extends CI_Controller {
    	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('filemanager_model');
        $this->load->helper('url','form','filemanager','text');		
								  		
    }
	
	public function index()
	{
		$this->load->helper('filemanager');	
		
		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{
			
			//Security Data			
			$data['token'] = strtoupper(sha1(date("Ymdhis")));				
			//Static Data	
			$data['title'] = "Administrador de Archivos";	
			$data['content'] = "folder";
			$data['action'] = "filemanager/save";
			//Styled Data
			$data['js_files'] = array("0"=>"js/jstree/dist/jstree.min",
									  "1"=>"js/modules/filemanager/filemanager");
									  
			$data['css_files'] = array("0"=>"js/jstree/dist/themes/default/style.min",
									   "1"=>"js/jstree/dist/themes/default-dark/style.min");	
			//Model Data
			$data["folder"] = $this->filemanager_model->folder();
			$data["usuario"] = $this->filemanager_model->usuario();
			//Session Data		
			$data['session'] = $this->session->userdata('data');
			$this->load->view('templates/v1/template_v1',$data);
		}
	}
	
	public function save(){
				
		$post = $this->input->post(); //Almaceno el post para darle mejor manejo
		$CantidadUsuarios = 0;	//Variable para almacenar la cantidad de usuarios insertados en ms_mp_foldusu
		
		if(count($post["Usuarios"]) > 0){
		
			$session = $this->session->userdata('data');
									
			$data = array("Nombre"=>$post["Nombre"],
						  "Encriptado"=>strtoupper(sha1($post["Nombre"])),
						  "FolderPadreId"=>$post["FolderPadreId"],
						  "Status"=>$post["Status"],
						  "FecCrea"=>date("Y-m-d"),	
						  "UsuarioId"=>$session["id_usuario"]
						  );
						  
			$Result = $this->filemanager_model->save($data);		
			
			if($Result > 0){
										
				for($x=0; $x<count($post["Usuarios"]);$x++){
					
					$ResultFoldUsu = $this->filemanager_model->saveFolderUsuario($Result,$post["Usuarios"][$x]);
					
					if($ResultFoldUsu > 0){
						
						$CantidadUsuarios++;
					}
				}
										
				if($CantidadUsuarios > 0){	
				
					$this->session->set_flashdata("msg_success","Se inserto un registro satisfactoriamente");
					redirect(base_url()."filemanager");							
				
				}else{
					
					$this->session->set_flashdata("msg","Problemas al dar permisos de carpeta al usuario.");
					redirect(base_url()."filemanager");
				}
				
			}else{
				
				$this->session->set_flashdata("msg","Problemas al insertar el registro");
				redirect(base_url()."filemanager");
			}
				
		}else{
			
			$this->session->set_flashdata("msg","Debe seleccionar al menos un usuario");
			redirect(base_url()."filemanager");
		}
			
	}	
	
	public function file_upload($folderId,$encriptado)
	{	
		 $this->load->helper('text');		
	
		//php.ini modifications
		ini_set('memory_limit', '200M' );
		ini_set('upload_max_filesize', '200M');  
		ini_set('post_max_size', '200M');  
		ini_set('max_input_time', 3600);  
		ini_set('max_execution_time', 3600);
	
		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{
			
			if($this->filemanager_model->folder_view($folderId) != false){
				
				//Static Data	
				//$data['title'] = "Atras";	
				$data['content'] = "file_upload";
				$data['action'] = "filemanager/file_upload_save";
				
				//Get Data
				$data['folderId'] = $folderId;	
				$data['encriptado'] = $encriptado;	
				
				//Styled Data
				$data['js_files'] = array("0"=>"js/jstree/dist/jstree.min",
										  "2"=>"js/modules/filemanager/filemanager");
										  
				$data['css_files'] = array();	
				//Model Data
				$data["folder"] = $this->filemanager_model->folder_view($folderId);	
				$data["archivo"] = $this->filemanager_model->files_folder($folderId);	
						
				//Session Data		
				$data['session'] = $this->session->userdata('data');
				$this->load->view('templates/v1/template_v1',$data);
			
			}else{
				
				$this->session->set_flashdata("msg","Esta carpeta no existe o no esta activa, comuniquese con el administrador.");
				redirect(base_url()."filemanager");
			}
		}
	}
	
	
	public function file_upload_save(){
		
		//php.ini modifications
		ini_set('memory_limit', '200M' );
		ini_set('upload_max_filesize', '200M');  
		ini_set('post_max_size', '200M');  
		ini_set('max_input_time', 3600);  
		ini_set('max_execution_time', 3600);
		
		//Start Libraries		
		$this->load->helper('file');		
		$this->load->library('upload');		
		
		//Data from post and session			
		$post = $this->input->post(); //Almaceno el post para darle mejor manejo			
		$session = $this->session->userdata('data'); //Recibo los datos de sesion.
		
		
		//Start Upload	
		$Archivo = "Archivo";	
		$config['upload_path'] = 'private/filemanager/';
		$config['max_size'] = '0';	
		$config['allowed_types'] = 'jpg|png|doc|docx|pdf|xls|xlsx|ppt|pptx|txt|zip';
		$config['remove_spaces'] = true;
		$config['max_size'] = "0";
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		
		if (!$this->upload->do_upload($Archivo))
		{
			$error = array('error' => $this->upload->display_errors());	
			die(print_r($error));		
			$this->session->set_flashdata("msg","Error cargando el archivo");
			redirect(base_url()."filemanager/file_upload/".$post["FolderId"]."/".$post["encriptado"]);		
		}
		else
		{
			
			$data = array('upload_data' => $this->upload->data()); //Array con los datos de carga
						
			$dataArchivo = array("Nombre"=>strtoupper(str_replace(" ","-",$post["Nombre"])),
								 "NombreArchivo"=>$data['upload_data']["file_name"],
								 "Encriptado"=>strtoupper(sha1($data['upload_data']["file_name"])),
								 "Extension"=>$data['upload_data']["file_type"],
								 "Tamano"=>$data['upload_data']["file_size"],
								 "Archivo"=>$data['upload_data']["raw_name"],
								 "Status"=>1,
								 "FecCrea"=>date("Y-m-d"),	
								 "UsuarioId"=>$session["id_usuario"]
								 );
								 								 
			$Result = $this->filemanager_model->file_upload_save($dataArchivo);
			
			if($Result > 0){
					
				$ResultFoldArch = $this->filemanager_model->saveFolderArchivo($Result,$post["FolderId"]);
							
			}
									
			if($ResultFoldArch > 0){	
			
				$this->session->set_flashdata("msg_success","Se cargo el archivo satisfactoriamente.");
				redirect(base_url()."filemanager/file_upload/".$post["FolderId"]."/".$post["encriptado"]);							
			
			}else{
				
				$this->session->set_flashdata("msg","Problemas al insertar el registro.");
				redirect(base_url()."filemanager/file_upload/".$post["FolderId"]."/".$post["encriptado"]);
			}
						
		}			
		//End Upload			
	}	
	
	
	public function files()
	{	
	
		//Load Helpers
		$this->load->helper('filemanager');	
		$this->load->helper('text');
		
		//Load Data
		$session = $this->session->userdata('data'); //Recibo los datos de sesion.
		
		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{
				
			//Static Data	
			$data['title'] = "Sistema de Gestion";	
			$data['content'] = "files";
			$data['action'] = "filemanager/save";
			//Styled Data
			$data['js_files'] = array("0"=>"js/jstree/dist/jstree.min",
									  "1"=>"js/DataTables-1.10.12/media/js/jquery.dataTables.min",
									  "2"=>"js/DataTables-1.10.12/media/js/dataTables.bootstrap.min",
									  "3"=>"js/modules/filemanager/filemanager");
									  
			$data['css_files'] = array("0"=>"js/jstree/dist/themes/default/style.min",
									   "1"=>"js/jstree/dist/themes/default-dark/style.min",
									   "2"=>"js/DataTables-1.10.12/media/css/dataTables.bootstrap.min");	
			//Model Data
			$data["folder"] = $this->filemanager_model->folder_parent0($session["id_usuario"]);
			$data["archivo"] = $this->filemanager_model->files_folder_view(0);	
			
			//Session Data		
			$data['session'] = $this->session->userdata('data');
			$this->load->view('templates/v1/template_v1',$data);
		}
	}
	
	
	public function files_folder_view($folderId,$encriptado)
	{	
		//Load Helpers
		$this->load->helper('text');
				
		//Load Data
		$session = $this->session->userdata('data'); //Recibo los datos de sesion.	
		
		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{
			
			if($this->filemanager_model->folder_view($folderId) != false){
				
				//Static Data	
				//$data['title'] = "Sistema de Gestion";	
				$data['content'] = "files_view";
				$data['action'] = "filemanager/file_upload_save";
				$data['lastFolderId'] = $folderId;
				$data['encriptado'] = $encriptado;
				
				//Get Data
				$data['folderId'] = $folderId;	
				$data['encriptado'] = $encriptado;	
				
				//Styled Data
				$data['js_files'] = array("0"=>"js/jstree/dist/jstree.min",
										  "1"=>"js/DataTables-1.10.12/media/js/jquery.dataTables.min",
										  "2"=>"js/modules/filemanager/filemanager");
										  
				$data['css_files'] = array("0"=>"js/DataTables-1.10.12/media/css/jquery.dataTables.min",
										   "1"=>"js/DataTables-1.10.12/media/css/dataTables.bootstrap.min");	
				//Model Data
				$data["folderData"] = $this->filemanager_model->folder_view($folderId);
				$data["folder"] = $this->filemanager_model->folder_usuario_view($folderId,$session["id_usuario"]);	
				$data["archivo"] = $this->filemanager_model->files_folder_view($folderId);	
						
				//Session Data		
				$data['session'] = $this->session->userdata('data');
				$this->load->view('templates/v1/template_v1',$data);
			
			}else{
				
				$this->session->set_flashdata("msg","Esta carpeta no existe o no esta activa, comuniquese con el administrador.");
				redirect(base_url()."filemanager");
			}
		}
	}
	
	public function get_folders(){

		echo $this->filemanager_model->get_folders();
	}

	
	public function download_file($archivoId,$encriptado,$file)
	{	
		//Load Helpers
		$this->load->helper('text');
		$this->load->helper('download');
				
		//Load Data
		$session = $this->session->userdata('data'); //Recibo los datos de sesion.	
		
		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{
			
			if($this->filemanager_model->file_view($archivoId) != false){
				
				$data = array("ArchivoId"=>$archivoId,
							  "UsuarioId"=>$session["id_usuario"],
							  "FechaDescarga"=>date("Y-m-d"),	
							  "HoraDescarga"=>date("H:i:s"),
							  "DireccionIP"=>$_SERVER['REMOTE_ADDR'],
							  "Navegador"=>$_SERVER['HTTP_USER_AGENT']
							 );
								 								 
				$Result = $this->filemanager_model->download_file($data);
				
				if($Result != false){
					
					$data = file_get_contents(base_url()."private/filemanager/".$file); // Read the file's contents
					$name = $file;
					
					force_download($name,$data);
				
					$this->session->set_flashdata("msg_success","Su descarga se realizo satisfactoriamente");
					redirect(base_url()."filemanager/");
				
				}else{
					
					$this->session->set_flashdata("msg_error","Problemas al descargar el archivo");
					redirect(base_url()."filemanager");
				}
			
			}else{
				
				$this->session->set_flashdata("msg","Este archivo no existe o no esta activo, comuniquese con el administrador.");
				redirect(base_url()."filemanager");
			}
		}
	}
	
	
	public function share_file($archivoId,$encriptado)
	{	
		//Load Helpers
		$this->load->helper('text');
				
		//Load Data
		$session = $this->session->userdata('data'); //Recibo los datos de sesion.	
		
		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{
			
			if($this->filemanager_model->share_file($archivoId) != false){
				
				//Static Data	
				$data['title'] = "File Share";	
				$data['content'] = "file_share";
				$data['action'] = "filemanager/share_file_send";				
				$data['encriptado'] = $encriptado;
				
				//Get Data
				$data['archivoId'] = $archivoId;	
				$data['encriptado'] = $encriptado;	
				
				//Styled Data
				$data['js_files'] = array("0"=>"js/jstree/dist/jstree.min",
										  "1"=>"js/DataTables-1.10.12/media/js/jquery.dataTables.min",
										  "2"=>"js/modules/filemanager/filemanager");
										  
				$data['css_files'] = array("0"=>"js/DataTables-1.10.12/media/css/jquery.dataTables.min",
										   "1"=>"js/DataTables-1.10.12/media/css/dataTables.bootstrap.min");	
				//Model Data				
				$data["archivo"] = $this->filemanager_model->share_file($archivoId);	
						
				//Session Data		
				$data['session'] = $this->session->userdata('data');
				$this->load->view('templates/v1/template_v1',$data);
			
			}else{
				
				$this->session->set_flashdata("msg","Esta carpeta no existe o no esta activa, comuniquese con el administrador.");
				redirect(base_url()."filemanager");
			}
		}
	}
	
	
	public function share_file_send()
	{	
		//Data from post and session			
		$post = $this->input->post(); //Almaceno el post para darle mejor manejo				
		$session = $this->session->userdata('data'); //Recibo los datos de sesion.
		$link = sha1(date("Ymdhis"));	
		
		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{
			
			if($this->filemanager_model->file_view($post["archivoId"]) != false){
				
				$data = array("ArchivoId"=>$post["archivoId"],
							  "Link"=>$link,
							  "CantDesc"=>$post["CantDesc"],
							  "Asunto"=>$post["Asunto"],
							  "Mensaje"=>$post["Mensaje"],
							  "Email"=>$post["Email"],							 
							  "UsuarioId"=>$session["id_usuario"],
							  "FecCrea"=>date("Y-m-d"),	
							  "HorCrea"=>date("H:i:s")
							 );
								 								 
				$Result = $this->filemanager_model->share_file_save($data);
				
				if($Result != false){
					
					 $dataMail["Asunto"] = $post["Asunto"];
					 $dataMail["Mensaje"] = $post["Mensaje"];	
					 $dataMail["Link"] = $link;				
					
					 //Load email library 
					 $this->load->library('email'); 
			   
					 $this->email->from("no-reply@xquadra.co", 'Xquadra S.A.S.'); 
					 $this->email->to($post["Email"]);
					 $this->email->set_mailtype("html");
					 $this->email->subject($post["Asunto"]); 
					 $message = $this->load->view('filemanager/mail/mail_file_shared',$dataMail,TRUE);
					 $this->email->message($message); 
			   
					 //Send mail 
					 if($this->email->send()){ 
						
						 $this->session->set_flashdata("msg_success","El archivo se compartió correctamente con ".$post["Email"]);
						 redirect(base_url()."filemanager/files");
							
					 }
					 else {
						
						 $this->session->set_flashdata("msg_success","Ocurrió un problema al compartir el archivo.");
						 redirect(base_url()."filemanager/files");
					 }								
				
				}else{
					
					
					
					
					
					$this->session->set_flashdata("msg_error","Problemas al descargar el archivo");
					redirect(base_url()."filemanager");
				}
			
			}else{
				
				$this->session->set_flashdata("msg","Este archivo no existe o no esta activo, comuniquese con el administrador.");
				redirect(base_url()."filemanager");
			}
		}
	}
	
	
	public function download_external($encriptado)
	{	
		
		//Load Helpers
		$this->load->helper('text');
		$this->load->helper('download');
					
		//Load Data				
		$Result = $this->filemanager_model->download_external_verify($encriptado);
				
		if($Result == false)
		{		
			redirect("http://www.xquadra.co");
			
		}else{
						
			if($Result->Descargas < $Result->CantDesc){
							
				$data = array("Descargas"=>$Result->Descargas + 1,							
							  "FecDesc"=>date("Y-m-d"),	
							  "HorDesc"=>date("H:i:s"),
							  "Direccion_Ip"=>$_SERVER['REMOTE_ADDR'],
							  "Navegador"=>$_SERVER['HTTP_USER_AGENT']
							 );
																 
				$Result2 = $this->filemanager_model->download_external_save($data,$encriptado);
								
				if($Result2 == true){
					
					$ResultFile = $this->filemanager_model->download_external_filename($Result->ArchivoId);
					
					$data2 = file_get_contents(base_url()."private/filemanager/".$ResultFile->NombreArchivo); // Read the file's contents
					$name = $ResultFile->NombreArchivo;
					
					force_download($name,$data2);
				
					redirect("http://www.xquadra.co");
				
				}else{
					
					$this->session->set_flashdata("msg_error","Problemas al descargar el archivo");
					redirect("http://www.xquadra.co");
				}	
				
			}else{

				redirect("http://www.xquadra.co");
			}
		}
	}
	
	
	public function AjaxLoadThird(){
					
		if (!$this->input->is_ajax_request()) {
		   
		   exit('No direct script access allowed');
		}else{									
			
			$Id = $this->input->post("Id");	
							
			$ThirdData = $this->register_model->AjaxLoadDataThird($Id); //Vista			
				
			print_r($ThirdData);
		}
	}	
	
	public function AjaxLoadRequirements(){
					
		if (!$this->input->is_ajax_request()) {
		   
		   exit('No direct script access allowed');
		   
		}else{									
			
			$Id = $this->input->post("Id");	
			
			if($Id > 0 || $Id != ""){
			
				$ThirdClassId = $this->register_model->AjaxLoadThirdClass($Id);
											
				$Requirements = $this->register_model->AjaxLoadRequirements($ThirdClassId["ClaseTerceroId"]); //Vista			
					
				print_r($Requirements);
				
			}else{
				
				return false;
				
			}
		}
	}
		
	
	private function set_upload_options(){   
		//upload an image options
		$config = array();
		$config['upload_path'] = './private/files/register';
		$config['allowed_types'] = 'gif|jpg|png|doc|pdf|docx|xls|xlsx';
		$config['max_size']      = '0';
		$config['encrypt_name']	= true;
		$config['overwrite']     = FALSE;
	
		return $config;
	}
	
}