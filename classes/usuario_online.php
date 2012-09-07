<?php
class usuario_online 
{
	var $identifier;
	var $numUsers;
	var $numUsersLogged;
	var $sess_data;
	var $valores_session;


	function usuario_online()
	{
		session_start();
		
 		$this->tempoConexao();
	}
	
	function setUsuario($id, $dados)
	{
		session_start();
		
		$_SESSION["sessionID"] = $id;
		
		if(!empty($_SESSION["sessionID"]))
		{
			if (!file_exists(session_save_path() . '/sess_' . $_SESSION["sessionID"]))
			{
				$_SESSION = NULL;
			}
		}
		
		if (empty($_SESSION["uniqueID"]))
			$_SESSION["uniqueID"] = md5(uniqid(rand(), true)); 
		
		$this->sess_values[] = $dados;
		$this->tempoConexao();			
		$this->numeroUsuarios++;
	}
	
	function tempoConexao()
	{
		$_SESSION["tempoConexao"] = time();
	}
	
	function getUsuarioOnline($szIdentifier = "", $tempo_checagem = 2) 
	{
		session_start();
		
		if(empty($_SESSION["sessionID"]))
			$_SESSION["sessionID"] = session_id();
		
		if ($szIdentifier == "")
			$szIdentifier = $_SERVER['HTTP_HOST'];
		
	  	$this->numUsers = 0;
	 	$this->numUsersLogged = 0;
	  
	 	$this->identifier = $szIdentifier; 
	 
	  	if (($handle = opendir(session_save_path())) == false) return -1;
	
	  	while (($file = readdir($handle)) != false) 
	  	{
			if (ereg("^sess", $file)) 
			{
	  			$this->sess_string_to_array(implode("",file(session_save_path() . '/' . $file)));
				$this->numUsers++;
				$this->sess_values[] = $this->sess_data;
				/*if(time() - $this->sess_data["tempoConexao"] < ($tempo_checagem * 60)) 
				{ 
	  				$this->sess_values[] = $this->sess_data;
				}*/
			}
		}
   		
		closedir($handle);
	}
	
	function delSessionID($_sessionID) 
	{
		unlink(session_save_path() . '/sess_' . $_sessionID);
	}
	
	function showNumberUsers() 
	{
		return $this->numUsers;
	}
	
	function sess_string_to_array($sd) 
	{
		$sess_array = array();
		$vars = preg_split('/[;}]/', $sd);
		for ($i=0; $i < sizeof($vars); $i++) 
		{
			$parts = explode('|', $vars[$i]);
			$key = $parts[0];
			$val = unserialize($parts[1].";");
			$sess_array[$key] = $val;
		}
		
		$this->sess_data = $sess_array;
	}
	
	function showUsers() 
	{
		return $this->sess_values;
	}
	
	function searchIT($szSessVar = "", $szString, $type = 1) 
	{
		$aResults = Array();
		foreach ($this->sess_values as $key => $aInfo) 
		{	
			if ($type == 1) 
			{
				if (strtolower($aInfo[$szSessVar]) == strtolower($szString)) 
				{
					$aResults[] = $this->sess_values[$key];
					break;
				}
			} 
			else 
			{
				
				if (is_int(strpos(strtolower($aInfo[$szSessVar]),strtolower($szString)))) 
				{
					$aResults[] = $this->sess_values[$key];
					break;
				}
			}
		}
		
		return $aResults;
	}
	
	function isThisMe($_sessionID) 
	{
		if ($_sessionID == $_SESSION["sessionID"]) 
		{
			return 1;
		} 
		else 
		{
			return 0;
		}
	}
}
?>