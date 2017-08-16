<?php

namespace Panel\DeepControllers;

use Models\BBN2 as MB;

class BBN2
{
	
	public function __construct()
	{

	}

	public function run()
	{
		$this->__run();
	}

	private function __run()
	{
		require __DIR__."/../../views/bbn2_index.php";
	}
}