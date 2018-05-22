<?php
// source: /media/pc/Data/Projects/opis-colibri/latte/tests/views/included.latte

use Latte\Runtime as LR;

class Template47d51d95c3 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
		?>This is included<?php
		return get_defined_vars();
	}

}
