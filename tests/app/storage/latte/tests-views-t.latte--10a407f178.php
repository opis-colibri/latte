<?php
// source: /media/pc/Data/Projects/opis-colibri/latte/tests/views/t.latte

use Latte\Runtime as LR;

class Template10a407f178 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
		echo LR\Filters::escapeHtmlText(call_user_func($this->filters->t, $key)) /* line 1 */;
		return get_defined_vars();
	}

}
