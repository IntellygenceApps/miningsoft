<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if (!function_exists('folders'))
{
    function folders($parentId = 0)
    {	
		$ci=& get_instance();
		
		$sql = "SELECT * FROM ms_mp_folder WHERE FolderPadreId = $parentId AND Status = 1"; 
		
		$query = $ci->db->query($sql);	
		$row = $query->result_array();		
		
		if($query->num_rows() > 0){
						
			echo "<ul>";
			
			foreach($row as $rows){
			
				echo "<li>";
				
					echo $rows["Nombre"];					
					folders($rows["FolderId"]);
				
				echo "</li>";
			}
			
			echo "</ul>";
				
		}else{
			
			return false;
		}		
	}
}


if (!function_exists('folders_usuario'))
{
    function folders_usuario($parentId = 0)
    {	
		$ci=& get_instance();
		
		$sql = "SELECT * FROM ms_mp_folder WHERE FolderPadreId = $parentId AND Status = 1"; 
		
		$query = $ci->db->query($sql);	
		$row = $query->result_array();		
		
		if($query->num_rows() > 0){
						
			echo "<ul>";
			
			foreach($row as $rows){
			
				echo "<li>";
				
					echo $rows["Nombre"];					
					folders_usuario($rows["FolderId"]);
				
				echo "</li>";
			}
			
			echo "</ul>";
				
		}else{
			
			return false;
		}		
	}
}

if (!function_exists('select_folder'))
{
    function select_folder($parentId = 0)
    {	
		$ci=& get_instance();
		
		$sql = "SELECT * FROM ms_mp_folder WHERE Status = 1"; 
		
		$query = $ci->db->query($sql);	
		$row = $query->result_array();		
		
		if($query->num_rows() > 0){
						
			echo "<select name='FolderPadreId' class='select2_single form-control' tabindex='-1' id='third' required>";
					
			echo "<option value='0'>Directorio Raiz</option>";		
				
			foreach($row as $rows){
			
				if($rows["FolderPadreId"] > 0){
				
					echo "<option value='".$rows["FolderId"]."'>";
					
						echo "../".$rows["Nombre"];										
						
					echo "</option>";
				
				}else{
					
					echo "<option value='".$rows["FolderId"]."'>";
					
						echo $rows["Nombre"];										
												
					echo "</option>";
				}
			}
			
			echo "</select>";
				
		}else{
			
			return false;
		}		
	}
}

//end application/helpers/filemanager_helper.php