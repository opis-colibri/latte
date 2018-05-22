<?php
// source: /media/pc/Data/Projects/opis-colibri/latte/tests/views/simple.latte

use Latte\Runtime as LR;

class Template97fe9238e2 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
		?>abc<?php
		return get_defined_vars();
	}

}
