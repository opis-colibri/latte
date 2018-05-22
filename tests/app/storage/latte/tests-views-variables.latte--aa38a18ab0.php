<?php
// source: /media/pc/Data/Projects/opis-colibri/latte/tests/views/variables.latte

use Latte\Runtime as LR;

class Templateaa38a18ab0 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
		echo LR\Filters::escapeHtmlText($a) /* line 1 */ ?>-<?php
		echo LR\Filters::escapeHtmlText(call_user_func($this->filters->upper, $b)) /* line 1 */;
		return get_defined_vars();
	}

}
