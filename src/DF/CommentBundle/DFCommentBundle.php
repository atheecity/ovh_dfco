<?php

namespace DF\CommentBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DFCommentBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSCommentBundle';
	}
}
