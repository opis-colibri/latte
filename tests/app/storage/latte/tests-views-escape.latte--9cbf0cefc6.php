<?php
// source: /media/pc/Data/Projects/opis-colibri/latte/tests/views/escape.latte

use Latte\Runtime as LR;

class Template9cbf0cefc6 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
		if ($escape) {
			echo LR\Filters::escapeHtmlText($content) /* line 2 */ ?>

<?php
		}
		else {
			echo $content /* line 4 */ ?>

<?php
		}
		return get_defined_vars();
	}

}
