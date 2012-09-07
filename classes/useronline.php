<?
session_start();
class UsersOnline {
	var $identifier;
	var $numUsers;
	var $numUsersLogged;
	var $sess_data;
	var $sess_values;

	function UsersOnline() {
		session_start();
		
 		$this->keepAlive();
 	}
	
	function getUsersOnline($szIdentifier = "", $checkTime = 2) 
	{
		session_start();
		
		if(empty($_SESSION["ssSessionID"])) {
			$_SESSION["ssSessionID"] = session_id();
		}
		
		if ($szIdentifier == "") {
			$szIdentifier = $_SERVER['HTTP_HOST'];
		}
		
	  $this->numUsers = 0;
	  $this->numUsersLogged = 0;
	  
	 	$this->identifier = $szIdentifier; 
	 
	  if (($handle = opendir(session_save_path())) == false) return -1;
	
	  while (($file = readdir($handle)) != false) 
	  {
			if (ereg("^sess", $file)) 
			{
	  		$this->sess_string_to_array(implode("",file(session_save_path() . '/' . $file)));

	  		if ($this->sess_data[site] == $this->identifier) 
	  		{
					if(time() - $this->sess_data["ssKeepAlive"] < ($checkTime * 60)) 
					{ 
	  				$this->sess_values[] = $this->sess_data;
		  			
						$this->numUsers++;
						
						if (!$this->isGuest($this->sess_data["ssSessionID"])) {
							$this->numUsersLogged++;
						}
							
					} else {
	  					$this->delSessionID($this->sess_data["ssSessionID"]);
					}
				}
			}
		}
   	closedir($handle);
	}
	
	
	function &setUser($aData, $szSite = "") 
	{
		session_start();
		
		if(!empty($_SESSION["ssSessionID"])) {
			if (!file_exists(session_save_path() . '/sess_' . $_SESSION[ssSessionID])) {
				$_SESSION = NULL;
			}
		}
		
		($szSite == "") ? $_SESSION["site"] = $_SERVER['HTTP_HOST'] : $_SESSION["site"] = $szSite;
				
		if ($aData == "Guest") {
			if(empty($_SESSION["ssUniqueID"])) {
				$_SESSION["ssUniqueID"] = "Guest".$this->counter();
			}
		} else {
			if ((empty($_SESSION["ssUniqueID"])) || ($this->isGuest($_SESSION["ssSessionID"]))) {
				$_SESSION["ssUniqueID"] = md5(uniqid(rand(),1)); 		
			}

			foreach ($aData as $key => $value) {
				$_SESSION[$key] = $value;
			}	
			
			$_SESSION["ssTimeLogin"] = time(); 		

		}

		if ((empty($_SESSION["ssFirstTime"])) || (!empty($_SERVER['HTTP_REFERER']) && ($_SERVER['HTTP_REFERER'] != "") && (!is_int(strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']))))){
			$_SESSION["ssFirstTime"] = time(); 		
		}
		
		$this->keepAlive();

		$_SESSION["ssSessionID"] = session_id();
		
		if(empty($_SESSION["ssIP"])) {
			(getenv(HTTP_X_FORWARDED_FOR)) ? $_SESSION["ssIP"] = getenv(HTTP_X_FORWARDED_FOR) : $_SESSION["ssIP"] = getenv(REMOTE_ADDR);

			$this->sess_values[] = $_SESSION;
			  			
			$this->numUsers++;

		}
		
	}

	function &keepAlive() {
		$_SESSION["ssKeepAlive"] = time();
	}

	function IDLETime($_sessionID) {
		$aResult = $this->searchIT("ssSessionID",$_sessionID,1);
		if ($aResult[0]["ssSessionID"] == $_sessionID) {
			// Se for o sessionID do usuário atual então ele tem que retornar 0
			if ($aResult[0]["ssSessionID"] == $_SESSION["ssSessionID"]) {
				return $this->formatTime(0);
			} else {
				return $this->formatTime(time()-$aResult[0]["ssKeepAlive"]);
			}
		}
		return 0;
	}
	
	function getOnlineTime($_sessionID) {
		if ($_sessionID == "me") {
			return $this->formatTime(time() - $_SESSION["ssFirstTime"]);
		} else {
			$aResult = $this->searchIT("ssSessionID",$_sessionID,1);
			return $this->formatTime(time() - $aResult[0]["ssFirstTime"]);
		}
	}
	
	function timeLogin($_sessionID,$type = 1) {
		$aResult = $this->searchIT("ssSessionID",$_sessionID,1);
		if ($type == 1) {
			return $this->formatTime(time() - $aResult[0]["ssTimeLogin"]);
		} else if ($type == 2) {
			$aResult = $this->searchIT("ssSessionID",$_sessionID,1);
			return strftime("%d/%m/%Y - %H:%M:%S",(time() - $aResult[0]["ssTimeLogin"]));
		}
	}
	
	function showNumberUsers() {
		return $this->numUsers;
	}

	function showNumberUsersLogged() {
		return $this->numUsersLogged;
	}
	
	function showUsers() {
		return $this->sess_values;
	}
	
	function firstTime($_sessionID) {
		$aResult = $this->searchIT("ssSessionID",$_sessionID,1);
		return strftime("%d/%m/%Y - %H:%M:%S ",$aResult[0]["ssFirstTime"]);
	}
	
	function isThisMe($_sessionID) {
		if ($_sessionID == $_SESSION["ssSessionID"]) {
			return 1;
		} else {
			return 0;
		}
	}
	
	function isGuest($_sessionID) {
		$aResult = $this->searchIT("ssSessionID",$_sessionID,1);
		if (is_int(strpos($aResult[0]["ssUniqueID"],"Guest"))) {
			return 1;
		} else {
			return 0;
		}
	}

	function isLogged($_sessionID) {
		$aResult = $this->searchIT("ssSessionID",$_sessionID,1);
		if (!is_int(strpos($aResult[0]["ssUniqueID"],"Guest"))) {
			return 1;
		} else {
			return 0;
		}
	}
	
	function searchIT($szSessVar = "", $szString, $type = 1) {
		$aResults = Array();

		foreach ($this->sess_values as $key => $aInfo) 
		{
			if ($szSessVar == "") 
			{
				foreach ($aInfo as $szVar => $szData) 
				{
					if ($szVar == "ssFirstTime") 
					{
						$szData = strftime("%d/%m/%Y - %H:%M:%S",$szData);
					}
					
					
					if ($type == 1) 
					{
						if (strtolower($szData) == strtolower($szString)) 
						{
							$aResults[] = $this->sess_values[$key];
							break;
						}
					} 
					else 
					{
						if (is_int(strpos(strtolower($szData),strtolower($szString)))) 
						{
							$aResults[] = $this->sess_values[$key];
							break;
						}
					}
				}
			} 
			else
			{
				if ($szSessVar == "ssFirstTime") 
				{
					$aInfo[$szSessVar] = strftime("%d/%m/%Y - %H:%M:%S",$aInfo[$szSessVar]);
				}
				
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
		}
		return $aResults;
	}
	
	function &closeConnect() {
		$aTmp["ssFirstTime"] = $_SESSION["ssFirstTime"];
		session_destroy();
		$this->delSessionID($_SESSION["ssSessionID"]);
		session_start();
		while (list($key,$value) = each($aTmp)) {
			$_SESSION[$key] = $value;
		}
		
	}
	
	function &delSessionID($_sessionID) {
		@unlink(session_save_path() . '/sess_' . $_sessionID);
	}
	
	function sess_string_to_array($sd) {
		
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
	
	function &formatTime($_secs) 
	{
		$format = "";
		$days = bcmod((intval($_secs) / 86400),60); 
		$hours = intval(intval($_secs) / 3600); 
		if ($hours >= 24) {
			$days = $hours/24;
		  $hours = $hours-24;
		  $format .= "$days dias,";
		  $format .= $hours."h"; 
		}
		else if ($hour > 0)
		{
			$format .= $hours."h"; 
		}
		
		$minutes = bcmod((intval($_secs) / 60),60); 
		($minutes < 10) ? $format .= "0".$minutes."m" : $format .= $minutes."m"; 
		$seconds = bcmod(intval($_secs),60); 
		($seconds < 10) ? $format .= "0".$seconds."s" : $format .= $seconds."s"; 
		return $format;
	}
	
	function &counter() 
	{
		$datName = "ssGuestCounter".$_SERVER['HTTP_HOST'].".dat";
		
		if(!is_file("/tmp/$datName")) 
		{
			$fp = fopen(session_save_path() . "/$datName", "w");
			flock($fp, LOCK_SH);
			flock($fp, LOCK_EX);
			fwrite($fp, "1"); 
			flock($fp, LOCK_UN);
			fclose($fp);
			return 1;
		} else {
			$fp = fopen("/tmp/$datName", "r+");
			flock($fp, LOCK_SH);
			$counter = (int)fread($fp, filesize("/tmp/$datName"));
			$counter++; 
			rewind($fp);
			flock($fp, LOCK_EX);
			fwrite($fp, $counter); 
			flock($fp, LOCK_UN);
			fclose($fp);
			return $counter;
		}
	}	
}
// ############################################################################################################### //
?>