<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class master extends CI_Controller {
   
    public function __construct()
    {
	    parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');     		
    }
	
	public function index()
	{
		if(!$this->session->userdata('data'))
		{		
			redirect(base_url().'login');
			
		}else{
				
			redirect(base_url().'home');
		}
	}
	
	
	public function _example_output($output = null)
	{		
		$this->load->view('templates/v1/GC_template_v1.php',$output);
	}
	
	//1.   Security Masters
	//1.1. [Usuarios]
	
	public function user()
	{
		try{
			$crud = new grocery_CRUD();			
			$crud->set_table('ms_ms_usuario');			
			$crud->set_subject('Usuarios');	
			$crud->unset_delete();
			$crud->unset_fields('Aud_FecRegist','Aud_FecUltLog','Aud_UsuaCreador','Aud_HorUltLog','Aud_FecUCaCla','UltimaDirIp');
			$crud->unset_edit_fields('Clave','Aud_FecRegist','Aud_FecUltLog','Aud_UsuaCreador','Aud_HorUltLog','Aud_FecUCaCla','UltimaDirIp');
			$crud->required_fields('Nombres','Apellidos','Sexo','Email','FechaNac','Usuario','Clave','Status');
			$crud->columns('Foto','Nombres','Apellidos','Sexo','Email','Usuario','Status');			
			$crud ->display_as ('FechaNac', 'Fecha Nacimiento');
			$crud ->display_as ('CargoId', 'Cargo');
			$crud ->display_as ('PerfilId', 'Perfil');
			$crud ->set_relation ('CargoId', 'ms_ms_cargo', 'Nombre');
			$crud ->set_relation ('PerfilId', 'ms_ms_perfil', 'Nombre');
			$crud->set_relation_n_n('Opciones', 'ms_ms_usuariopcion', 'ms_ms_opcion', 'UsuarioId', 'OpcionId', 'Nombre','Orden');
			$crud->set_field_upload('Foto','assets/uploads/profiles');			
			$crud->callback_before_insert(array($this,'encrypt_password_callback'));
			$crud->callback_before_update(array($this,'encrypt_password_callback'));
								
			$output = $crud->render();			
			
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	
	public function process()
	{
		try{
			$crud = new grocery_CRUD();
			$crud->set_table('ms_mp_proceso');
			$crud->set_subject('Procesos');
			$crud->unset_delete();
			$crud->required_fields('Nombre','Status');
			$crud->columns('Nombre','Descripcion','Status');
							
			$output = $crud->render();			
			
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	//1.   Security Masters
	//1.2. [Perfiles]
	
	public function profile()
	{
		try{
			$crud = new grocery_CRUD();			
			$crud->set_table('ms_ms_perfil');
			$crud->set_subject('Perfiles de Usuarios');			
			$crud->required_fields('Nombres','Status');
			$crud->unset_delete();
			$output = $crud->render();			
			
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	
	//1.   Security Masters
	//1.3. [Cargos]
	
	public function position()
	{
		try{
			$crud = new grocery_CRUD();			
			$crud->set_table('ms_ms_cargo');
			$crud->set_subject('Cargos de Usuario');
			$crud->unset_delete();
			$crud->columns('Nombre','OficialCumplimiento','Status');			
			$crud->required_fields('NombreCargo');			
			$crud ->display_as ('OficialCumpliemiento', 'Es oficial de cumplimiento');
			//$crud->set_relation_n_n('Valoraciones', 'ms_se_cargovalora','ms_co_valoracion','CargoId','ValoracionId','Nombre','Orden');
			
			$output = $crud->render();			
			
			$this->_example_output($output);

		}catch(Exception $e){
			
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	//1.   Security Masters
	//1.4. [Modulos]
	
	public function module()
	{
		try{
			$crud = new grocery_CRUD();			
			$crud->set_table('ms_ms_modulo');
			$crud->set_subject('Modulos del Sistema');			
			$crud->required_fields('Nombre','Status');
			
			$output = $crud->render();			
			
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	//1.   Security Masters
	//1.5. [Opciones de Modulos]
	
	public function typeoption()
	{
		try{
			$crud = new grocery_CRUD();			
			$crud->set_table('ms_ms_tipoopc');
			$crud->set_subject('Tipo de Opciones');			
			$crud->required_fields('Nombre','Simbolo','Status');
						
			$output = $crud->render();			
			
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	//1.   Security Masters
	//1.6. [Opciones de Modulos]
	
	public function moduleoption()
	{
		try{
			$crud = new grocery_CRUD();			
			$crud->set_table('ms_ms_opcion');
			$crud->set_subject('Opciones del Sistema');			
			$crud->required_fields('Nombre','ModuloId','Status','TipoOpcionId');
			$crud->set_relation('ModuloId', 'ms_ms_modulo', 'Nombre');	
			$crud->set_relation('TipoOpcionId', 'ms_ms_tipoopc', 'Nombre');	
			$crud ->display_as('ModuloId', 'Modulo');
			$crud ->display_as('TipoOpcionId', 'Tipo Opción');
			
			$output = $crud->render();			
			
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	
	//1.   Security Masters
	//1.7. [Opciones de Modulos]
	
	public function comercial_process()
	{
		try{
			$crud = new grocery_CRUD();			
			$crud->set_table('ms_ms_proceso');
			$crud->set_subject('Procesos del Depto Comercial');			
			$crud->required_fields('Nombre','Status');				
						
			$output = $crud->render();			
			
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	
	//2.   Principal Masters
	//2.1. [Tipo Regimen]
		
	public function regimentype()
	{
		try{
			$crud = new grocery_CRUD();			
			$crud->set_table('ms_mp_tiporeg');
			$crud->set_subject('Regimen de Terceros');			
			$crud->required_fields('Nombre','Status');
			$crud->unset_delete();			
			$output = $crud->render();			
			
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
		
	
	//2.   Principal Masters
	//2.2 [Tipo Identificación]
		
	public function identificationtype()
	{
		try{
			$crud = new grocery_CRUD();			
			$crud->set_table('ms_mp_tipoide');
			$crud->set_subject('Tipo de Identificación');			
			$crud->required_fields('Nombre','Sigla','Status');
			$crud->unset_delete();
						
			$output = $crud->render();			
			
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
		
			
	//2.   Principal Masters
	//2.2 [Tipo Tercero]		
	public function typethird()
	{
		try{
			$crud = new grocery_CRUD();			
			$crud->set_table('ms_mp_tipoter');
			$crud->set_subject('Tipo Tercero');			
			$crud->required_fields('Nombre','Sigla','Status');
			$crud->unset_delete();
				
			$output = $crud->render();			
			
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}	
		
		
	//2.   Principal Masters
	//2.3  [Clase Tercero]		
	public function thirdclass()
	{
		try{
			$crud = new grocery_CRUD();			
			$crud->set_table('ms_me_claster');
			$crud->set_subject('Clase Tercero');
			$crud->unset_delete();
			$crud->display_as('DiasGracia','Dias registro');		
			$crud->required_fields('Nombre','Status');			
			$crud->set_relation_n_n('Requisitos', 'ms_mp_reqxcla', 'ms_mp_requisi', 'ClaseTerceroId', 'RequisitoId', 'Nombre','Orden');
									
			$output = $crud->render();			
			
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}		
		
		
	//2.   Principal Masters
	//2.4  [Requisito]		
	public function requirement()
	{
		try{
			$crud = new grocery_CRUD();			
			$crud->set_table('ms_mp_requisi');
			$crud->set_subject('Requisito');
			$crud->display_as('TiprequiId','Tipo de Documento');			
			$crud->required_fields('Nombre','Codigo','Status');			
			$crud->set_field_upload('Archivo','assets/uploads/requirements');		
			$crud->unset_delete();
						
			$output = $crud->render();			
			
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}	
	
	public function requirement_tipe()
	{
		try{
			$crud = new grocery_CRUD();			
			$crud->set_table('ms_mp_tiprequi');
			$crud->set_subject('Tipo de Requisito');			
			$crud->required_fields('Nombre','Status');
			$crud->unset_delete();
								
			$output = $crud->render();			
			
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}			
		
		
	//2.   Principal Masters
	//2.5  [Tercero]		
	public function third()
	{
		try{
			$crud = new grocery_CRUD();		
			$crud->set_table('ms_mp_tercero');
			$crud->set_subject('Tercero');	
			$crud->unset_delete();		
			$crud->required_fields('ClaseTerceroId','TipoTerceroId','TipoIdentificacionId','TipoRegimenId',
									'PaisCodigo','DeptoCodigo','CiudadCodigo','NombreCompleto','Genero','Direccion',
									'Telefono','Celular','Email','FechaNac','Status');
			$crud->columns('ClaseTerceroId','NumeroIdentificacion','TipoTerceroId','NombreCompleto','Status');
			$crud ->set_relation ('ClaseTerceroId', 'ms_me_claster', 'Nombre');
			$crud ->set_relation ('TipoTerceroId', 'ms_mp_tipoter', 'Nombre');
			$crud ->set_relation ('TipoIdentificacionId', 'ms_mp_tipoide', 'Nombre');			
			$crud ->set_relation ('TipoRegimenId', 'ms_mp_tiporeg', 'Nombre');								
			$crud ->set_relation ('PaisCodigo', 'ms_mp_pais', 'Nombre');						
			$crud ->set_relation ('DeptoCodigo', 'ms_mp_depto', 'Nombre');						
			$crud ->set_relation ('CiudadCodigo', 'ms_mp_ciudad', 'Nombre');						
			$crud ->display_as ('ClaseTerceroId', 'Clase Tercero');
			$crud ->display_as ('TipoTerceroId', 'Tipo de Tercero');
			$crud ->display_as ('TipoIdentificacionId', 'Tipo de Identificación');
			$crud ->display_as ('TipoRegimenId', 'Tipo Regimen');
			$crud ->display_as ('PaisResid', 'Pais Residencia');
			$crud ->display_as ('PaisCodigo', 'Pais Residencia');
			$crud ->display_as ('DeptoCodigo', 'Departamento Residencia');
			$crud ->display_as ('CiudadCodigo', 'Ciudad Residencia');
			$crud ->display_as ('DepartamentoResid', 'Departamento');
			$crud->display_as('NumeroIdentificacion','Numero de Identificación');	
			$crud->display_as('DV','Digito de Verificación');	
			$crud->display_as('FechaExpedicion','Fecha de Expedicion');	
			$crud->display_as('NombreCompleto','Nombre Completo');	
			$crud->display_as('PrimerNombre','Primer Nombre');
			$crud->display_as('SegundoNombre','Segundo Nombre');
			$crud->display_as('PrimerApellido','Primer Apellido');
			$crud->display_as('SegundoApellido','Segundo Nombre');	
			$crud ->display_as ('CiudadResid', 'Ciudad');		
			$crud ->display_as ('AceptaRecibMails', 'Acepta recibir Emails');		
			$crud->unset_fields('Sync','Nuevo','DateCreation','TimeCreation');				
			$crud->set_field_upload('Foto','assets/uploads/third/foto');			
			$crud->callback_after_upload(array($this,'resize_image'));
			$this->load->library('gc_dependent_select');
			
			
			$fields = array(
							'PaisCodigo' => array(// first dropdown name
							'table_name' => 'ms_mp_pais', // table of country
							'title' => 'Nombre', // country title
							'relate' => null // the first dropdown hasn't a relation
							),
							'DeptoCodigo' => array(// second dropdown name
							'table_name' => 'ms_mp_depto', // table of state
							'title' => 'Nombre', // state title
							'id_field' => 'DeptoCodigo', // table of state: primary key
							'relate' => 'PaisCodigo', // table of state:
							'data-placeholder' => 'Seleccione un Pais' //dropdown's data-placeholder:
							),
							'CiudadCodigo' => array(// second dropdown name
							'table_name' => 'ms_mp_ciudad', // table of state
							'title' => 'Nombre', // state title
							'id_field' => 'CiudadCodigo', // table of state: primary key
							'relate' => 'DeptoCodigo', // table of state:
							'data-placeholder' => 'Seleccione un Departamento' //dropdown's data-placeholder:
							)
						);
						
			$config = array('main_table' => 'ms_mp_tercero',
							'main_table_primary' => 'TerceroId',
							"url" => base_url() . __CLASS__ . '/' . __FUNCTION__ . '/',
							'ajax_loader' => base_url() . 'ajax-loader.gif', // path to ajax-loader image. It's an optional parameter
							//'segment_name' =>'Your_segment_name' // It's an optional parameter. by default "get_items"
							);
			
			$categories = new gc_dependent_select($crud, $fields, $config);
			$js = $categories->get_js();
			
			$output = $crud->render();			
			$output->output.= $js;
			
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
		
	public function commercial_valoration()
	{
		try{
			$crud = new grocery_CRUD();			
			$crud->set_table('ms_co_valoracion');
			$crud->set_subject('Tipo de Valoracion');			
			$crud->required_fields('Nombre','Status');
			$crud ->display_as ('UsuarioId', 'Usuario Encargado');
			$crud ->set_relation ('UsuarioId', 'ms_ms_usuario', 'Nombres');
														
			$output = $crud->render();			
			
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}		
	
	
	public function position_valoration()
	{
		try{
			$crud = new grocery_CRUD();			
			$crud->set_table('ms_ms_cargovalora');
			$crud->set_subject('Valoraciones por Cargo');			
			$crud->required_fields('Nombre');
								
			$output = $crud->render();			
			
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}		
		
		
	public function grande()
	{
		try{
			$crud = new grocery_CRUD();
			$crud->set_theme('flexigrid');
			$crud->set_table('dm_producto');
			$crud->set_subject('Producto');			
			$crud->required_fields('Nombre','MarcaId','ClaseProductosId','Codigo');
			$crud->columns('Codigo','Nombre','Descripcion','ClaseProductoId','GrupoId','LineaId','MaterialId','UnidadMedidaId','Alto','Ancho','Diametro','Precio','MarcaId','EmpaqueId','AreaImpresion','FichaTecnica','Status');
			$crud->set_relation ('MarcaId', 'dm_marca', 'Nombre');
			$crud->set_relation ('ClaseProductoId', 'dm_claseproducto', 'Nombre');			
			$crud->set_relation ('MaterialId', 'dm_promaterial', 'Nombre');
			$crud->set_relation ('UnidadMedidaId', 'dm_prounidadmedida', 'Nombre');
			$crud->set_relation ('EmpaqueId', 'dm_proempaque', 'Descripcion');
			//$crud ->set_relation ('AreaImpresionId', 'dm_proareaimpresion', 'Descripcion');
			$crud ->set_relation ('GrupoId', 'dm_grupo', 'Nombre');
			$crud ->set_relation ('LineaId', 'dm_linea', 'Nombre');		
			$crud ->display_as ('MarcaId', 'Marca');
			$crud ->display_as ('ClaseProductoId', 'Clase del producto');
			$crud ->display_as ('LineaId', 'Linea de inventario');
			$crud ->display_as ('AreaImpresion', 'Area de impresión');
			$crud ->display_as ('FichaTecnica', 'Ficha tecnica');
			$crud ->display_as ('AreaImpresionId', 'Area de impresion');
			$crud ->display_as ('UnidadMedidaId', 'Unidad de medida');
			$crud ->display_as ('MaterialId', 'Material');
			$crud ->display_as ('EmpaqueId', 'Empaque');
			$crud ->display_as ('GrupoId', 'Grupo de inventario');
			$crud->set_field_upload('FichaTecnica','assets/uploads/ProductosFichaTecnica');			
			$crud->callback_after_upload(array($this,'resize_image'));
			$this->load->library('gc_dependent_select');
			
			
			$fields = array(
							'GrupoId' => array(// first dropdown name
							'table_name' => 'dm_grupo', // table of country
							'title' => 'Nombre', // country title
							'relate' => null // the first dropdown hasn't a relation
							),
							'LineaId' => array(// second dropdown name
							'table_name' => 'dm_linea', // table of state
							'title' => 'Nombre', // state title
							'id_field' => 'LineaId', // table of state: primary key
							'relate' => 'GrupoId', // table of state:
							'data-placeholder' => 'Seleccione un Grupo de Inventario' //dropdown's data-placeholder:
											  )
						);
			
			
			$config = array('main_table' => 'dm_producto',
							'main_table_primary' => 'ProductoId',
							"url" => base_url() . __CLASS__ . '/' . __FUNCTION__ . '/',
							//'ajax_loader' => base_url() . 'ajax-loader.gif', // path to ajax-loader image. It's an optional parameter
							//'segment_name' =>'Your_segment_name' // It's an optional parameter. by default "get_items"
							);
			
			$categories = new gc_dependent_select($crud, $fields, $config);
			$js = $categories->get_js();
			
			$output = $crud->render();			
			$output->output.= $js;
			
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	//CallBack resize image
	function resize_image($uploader_response,$field_info, $files_to_upload){
		
	   $this->load->library('image_moo');
		$file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name;		
		$thumb = $field_info->upload_path.'/thumbs/'.$uploader_response[0]->name;
		$pic = $this->image_moo->load($file_uploaded);
		$pic->resize(200,200)->save($file_uploaded,true);
		$pic->resize(100,100)->save($thumb,true);
		return true;
	}

	function encrypt_password_callback($post_array, $primary_key) {
			 
		//Encrypt password only if is not empty. Else don't change the password to an empty field
		if(!empty($post_array['Clave']))
		{
			
			$post_array['Clave'] = sha1($post_array['Clave'], $key);
		}
		else
		{
			unset($post_array['Clave']);
		}
	 
	  return $post_array;
	}
	
	
	
}
