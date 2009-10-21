<?php

class QXmlRpc_Client {
	protected $blnDebug = FALSE;
	protected $arrLog = array();

	protected function serialize($data, $level = 0, $prior_key = NULL){
		//assumes a hash, keys are the variable names
		$xml_serialized_string = "";
		while(list($key, $value) = each($data)){
			$inline = false;
			$numeric_array = false;
			$attributes = "";
			// echo "My current key is '$key', called with prior key '$prior_key'<br>";
			if(!strstr($key, " attr")){ // if it's not an attribute
				if(array_key_exists("$key attr", $data)){
					while(list($attr_name, $attr_value) = each($data["$key attr"])){
						//echo "Found attribute $attribute_name with value $attribute_value<br>";
						$attr_value = htmlspecialchars($attr_value, ENT_QUOTES);
						$attributes .= " $attr_name=\"$attr_value\"";
					}
				}

				if(is_numeric($key)){
					//echo "My current key ($key) is numeric. My parent key is '$prior_key'<br>";
					$key = $prior_key;
				}else{
					// you can't have numeric keys at two levels in a row, so this is ok
					 //echo "Checking to see if a numeric key exists in data.";
					if(is_array($value) and array_key_exists(0, $value)){
						//	echo " It does! Calling myself as a result of a numeric array.<br>";
						$numeric_array = true;
						$xml_serialized_string .= $this->serialize($value, $level, $key);
					}
					// echo "<br>";
				}

				if(!$numeric_array){
					$xml_serialized_string .= str_repeat("\t", $level) . "<$key$attributes>";

					if(is_array($value)){
						$xml_serialized_string .= "\r\n" . $this->serialize($value, $level+1);
					}else{
						$inline = true;
						$xml_serialized_string .= htmlspecialchars($value);
					}

					$xml_serialized_string .= (!$inline ? str_repeat("\t", $level) : "") . "</$key>\r\n";
				}
			}else{
				// echo "Skipping attribute record for key $key<bR>";
			}
		}
		if($level == 0){
			$xml_serialized_string = "<?xml version=\"1.0\" ?>\r\n" . $xml_serialized_string;
			return $xml_serialized_string;
		}else{
			return $xml_serialized_string;
		}
	}

	public static function prepare($data, $type = NULL){
		if(is_array($data)){
			$num_elements = count($data);
			if((array_key_exists(0, $data) or !$num_elements) and $type != 'struct'){ // it's an array
				if(!$num_elements){ // if the array is empty
					$returnvalue =  array('array' => array('data' => NULL));
				}else{
					$returnvalue['array']['data']['value'] = array();
					$temp = $returnvalue['array']['data']['value'];
					$count = is_array($array) ? count(array_filter(array_keys($array), 'is_numeric')) : 0;
					for($n=0; $n<$count; $n++){
						$type = NULL;
						if(array_key_exists("$n type", $data)){
							$type = $data["$n type"];
						}
						$temp[$n] = QXmlRpc::prepare($data[$n], $type);
					}
				}
			}else{ // it's a struct
				if(!$num_elements){ //if the struct is empty
					$returnvalue = array('struct' => NULL);
				}else{
					$returnvalue['struct']['member'] = array();
					$temp = $returnvalue['struct']['member'];
					while(list($key, $value) = each($data)){
						if(substr($key, -5) != ' type'){ //if it's not a type specifier
							$type = NULL;
							if(array_key_exists("$key type", $data)){
								$type = $data["$key type"];
							}
							$temp[] = array('name' => $key, 'value' => QXmlRpc::prepare($value, $type));
						}
					}
				}
			}
		}else{ // it's a scalar
			if(!$type){
				if(is_int($data)){
					$returnvalue['int'] = $data;
					return $returnvalue;
				}elseif(is_float($data)){
					$returnvalue['double'] = $data;
					return $returnvalue;
				}elseif(is_bool($data)){
					$returnvalue['boolean'] = ($data ? 1 : 0);
					return $returnvalue;
				}elseif(preg_match('/^\d{8}T\d{2}:\d{2}:\d{2}$/', $data, $matches)){ //it's a date
					$returnvalue['dateTime.iso8601'] = $data;
					return $returnvalue;
				}elseif(is_string($data)){
					$returnvalue['string'] = htmlspecialchars($data);
					return $returnvalue;
				}
			}else{
				$returnvalue[$type] = htmlspecialchars($data);
			}
		}
		return $returnvalue;
	}

	protected function adjustValue($current_node){

		if(is_object($current_node)){
			if(isset($current_node->array)){
				if(!is_object($current_node->array->data)){
					//If there are no elements, return an empty array
					//echo "If there are no elements, return an empty array";
					return array();
				}else{
					//echo "Getting rid of array -> data -> value<br>\n";
					$temp = $current_node->array->data->value;
					if(is_object($temp) and $temp[0]){
						$count = count($temp);
						for($n=0;$n<$count;$n++){
							$temp2[$n] = $this->adjustValue($temp[$n]);
						}
						$temp = $temp2;
					}else{
						$temp2 = $this->adjustValue($temp);
						$temp = array($temp2);
						//I do the temp assignment because it avoids copying,
						// since I can put a reference in the array
						//PHP's reference model is a bit silly, and I can't just say:
						// $temp = array($this->adjustValue($temp));
					}
				}
			}elseif(isset($current_node->struct)){
				if(!is_object($current_node->struct)){
					//If there are no members, return an empty array
					//echo "If there are no members, return an empty array";
					return array();
				}else{
					//echo "Getting rid of struct -> member<br>\n";
					$temp = $current_node->struct->member;
					if(is_object($temp) and isset($temp[0])){
						$count = count($temp);
						$temp2 = array();
						for($n=0;$n<$count;$n++){
							//echo "Passing name {$temp->$n->name}. Value is: " . $this->show($temp->$n->value, 'var_dump', true) . "<br>\n";
							$temp2[(string) $temp->$n->name]= $this->adjustValue($temp->$n->value);
							//echo "adjustValue(): After assigning, the value is " . $this->show($temp2[$temp->$n->name], 'var_dump', true) . "<br>\n";
						}
					}else{
						//echo "Passing name $temp[name]<br>\n";
						$temp2[(string)$temp->name] = $this->adjustValue($temp->value);
					}
					$temp = $temp2;
				}
			}else{
				$temp = '';
				$types = array('string', 'int', 'i4', 'double', 'dateTime.iso8601', 'base64', 'boolean');
				$fell_through = true;

				foreach($types as $type){
					if($current_node->$type){
						//echo "Getting rid of '$type'<br>\n";
						$temp = $current_node->$type;
						//echo "adjustValue(): The current node is set with a type of $type<br>\n";
						$fell_through = false;
						break;
					}
				}

				if($fell_through){
					$type = 'string';
					//echo "Fell through! Type is $type<br>\n";
				}
				switch ($type){
					case 'int': case 'i4': $temp = (int)$temp;    break;
					case 'string':         $temp = (string)$temp; break;
					case 'double':         $temp = (double)$temp; break;
					case 'boolean':        $temp = (bool)$temp;   break;
					case 'dateTime.iso8601': $temp = (string) date('Y-m-d H:i:s',strtotime($temp)); break;
				}
			}
		}else{
			$temp = (string)$current_node;
		}
		return $temp;
	}

	public function request($site, $location, $methodName, $params = NULL, $user_agent = NULL){
		$site = explode(':', $site);
		if(isset($site[1]) and is_numeric($site[1])){
			$port = $site[1];
		}else{
			$port = 80;
		}
		$site = $site[0];

		$data["methodCall"]["methodName"] = $methodName;
		$param_count = count($params);
		if(!$param_count){
			$data["methodCall"]["params"] = NULL;
		}else{
			for($n = 0; $n<$param_count; $n++){
				$data["methodCall"]["params"]["param"][$n]["value"] = $params[$n];
			}
		}
		$data = $this->serialize($data);

		if($this->blnDebug){
			$this->debug('XMLRPC_request', "<p>Received the following parameter list to send:</p>" . $this->show($params, 'print_r', true));
		}
		$conn = fsockopen ($site, $port); //open the connection
		if(!$conn){ //if the connection was not opened successfully
			if($this->blnDebug){
				$this->debug('XMLRPC_request', "<p>Connection failed: Couldn't make the connection to $site.</p>");
			}
			return array(false, array('faultCode'=>10532, 'faultString'=>"Connection failed: Couldn't make the connection to $site."));
		}else{
			$headers =
			"POST $location HTTP/1.0\r\n" .
			"Host: $site\r\n" .
			"Connection: close\r\n" .
			($user_agent ? "User-Agent: $user_agent\r\n" : '') .
			"Content-Type: text/xml\r\n" .
			"Content-Length: " . strlen($data) . "\r\n\r\n";

			fputs($conn, "$headers");
			fputs($conn, $data);

			if($this->blnDebug){
				$this->debug('XMLRPC_request', "<p>Sent the following request:</p>\n\n" . $this->show($headers . $data, 'print_r', true));
			}

			//socket_set_blocking ($conn, false);
			$response = "";
			while(!feof($conn)){
				$response .= fgets($conn, 1024);
			}
			fclose($conn);

			//strip headers off of response
			$response_pos = strpos($response, "\r\n\r\n") + 4;
			$response_strip = substr($response, $response_pos);
			$data = new SimpleXMLElement($response_strip);

			if($this->blnDebug){
				$this->debug('XMLRPC_request', "<p>Received the following response:</p>\n\n" . $this->show($response_strip, 'print_r', true) . "<p>Which was serialized into the following data:</p>\n\n" . $this->show($data, 'print_r', true));
			}

			if(isset($data->fault)){
				$return =  array(false, $this->adjustValue($data->fault->value));
				if($this->blnDebug){
					$this->debug('XMLRPC_request', "<p>Returning:</p>\n\n" . $this->show($return, 'var_dump', true));
				}
				return $return;
			}else{
				$return = array(true, $this->adjustValue($data->params->param->value));
				if($this->blnDebug){
					$this->debug('XMLRPC_request', "<p>Returning:</p>\n\n" . $this->show($return, 'var_dump', true));
				}
				return $return;
			}
		}
	}

	public function debug($function_name, $debug_message){
		$this->arrLog[$function_name][] = $debug_message;
	}

	public function debug_print(){
		if(is_array($this->arrLog) && !empty($this->arrLog)){
			echo "<table border=\"1\" width=\"100%\">\n";
			foreach($this->arrLog as $function){
				echo "<tr><th style=\"vertical-align: top\">$function</th></tr>\n";
				foreach($function as $message){
					echo "<tr><td><td>$message</td></tr>\n";
				}
			}	
			echo "</table>\n";
			//Reset Debug log
			//$this->arrLog = array()
		}else{
			echo "<p>No debugging information available yet.</p>";
		}
	}

	public function show($data, $func = "print_r", $return_str = false){
		ob_start();
		$func($data);
		$output = ob_get_contents();
		ob_end_clean();
		if($return_str){
			return "<pre>" . htmlspecialchars($output) . "</pre>\n";
		}else{
			echo "<pre>", htmlspecialchars($output), "</pre>\n";
		}
	}

	public function __set($strName, $mixValue) {
		$this->blnModified = true;

		switch ($strName) {
			case "Debug":
				try {
					$this->blnDebug = QType::Cast($mixValue, QType::Boolean);
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
		}
	}

	public function __get($strName) {
		switch ($strName) {
			case "Log": return $this->arrLog;
		}
	}
}
?>