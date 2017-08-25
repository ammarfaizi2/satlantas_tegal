<?php

namespace Panel\DeepControllers;

class ErrorPage
{
	public function run($code)
	{
		http_response_code($code);
		switch ($code) {
			case 404:
				echo "Not Found";
				break;
			
			default:
				echo "Error";
				break;
		}
	}
}