<?php

namespace DF\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DFUserBundle extends Bundle
{
	
	public function getParent()
	{
		return 'FOSUserBundle';
	}
	
}