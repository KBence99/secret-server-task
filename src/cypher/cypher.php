<?php

	/*
	Method for applying a cypher for a single character
	*/
	function cipher($ch, $key)
	{
		if (!ctype_alpha($ch))
			return $ch;

		$offset = ord(ctype_upper($ch) ? 'A' : 'a');
		return chr(fmod(((ord($ch) + $key) - $offset), 26) + $offset);
	}

	/*
	Method for ecnrypting a string
	*/
	function encipher($input, $key)
	{
		$output = "";

		$inputArr = str_split($input);
		foreach ($inputArr as $ch)
			$output .= Cipher($ch, $key);

		return $output;
	}

	/*
	Method for decrypting a string
	*/
	function decipher($input, $key)
	{
		return encipher($input, 26 - $key);
	}
?>