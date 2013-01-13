<?php

// it provides the functions for the AMF StringBuilder based on strings
if(!extension_loaded("amf"))
{
	function amf_sb_new()
	{
		return "";
	}

	function _amf_sb_append(&$sb,$a)
	{
		foreach($a as $v)
		{
			if(is_array($v))
				_amf_sb_append($sb,$v);
			else
				$sb .= $v;
		}
	}
	
	function amf_sb_append(&$sb)
	{
		$n = func_num_args();
		$r = $sb;
		for($i = 1; $i < $n; $i++)
		{
			$aa = func_get_arg($i);
			if(is_array($aa))
			{
				_amf_sb_append($r,$aa);
			}
			else
				$r .= $aa;
		}
		$sb = $r;
	}

	function amf_sb_length(&$sb)
	{
		return strlen($sb);
	}
	
	function amf_sb_write(&$sb,$stream=NULL)
	{
		if($stream == NULL)
			echo($sb);
		else
			fwrite($stream,$sb);
	}
    
    function amf_sb_echo(&$sb)
	{
		echo($sb);
	}
	
	function amf_sb_as_string(&$sb)
	{
		return $sb;
	}
    
	function amf_sb_flat(&$sb)
	{
		return $sb;
	}
}

?>