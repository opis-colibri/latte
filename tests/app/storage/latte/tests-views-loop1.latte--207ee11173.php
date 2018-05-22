<?php
// source: /media/pc/Data/Projects/opis-colibri/latte/tests/views/loop1.latte

use Latte\Runtime as LR;

class Template207ee11173 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
		$iterations = 0;
		foreach ($items as $item) {
			?>- <?php echo LR\Filters::escapeHtmlText($item) /* line 2 */ ?>

<?php
			$iterations++;
		}
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['item'])) trigger_error('Variable $item overwritten in foreach on line 1');
		
	}

}
