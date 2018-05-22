<?php
// source: /media/pc/Data/Projects/opis-colibri/latte/tests/views/included.php

use Latte\Runtime as LR;

class Templatedf74274fc4 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
		?><?php
<?= "Included php";
		return get_defined_vars();
	}

}
