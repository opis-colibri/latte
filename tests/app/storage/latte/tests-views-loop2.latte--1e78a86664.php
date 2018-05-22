<?php
// source: /media/pc/Data/Projects/opis-colibri/latte/tests/views/loop2.latte

use Latte\Runtime as LR;

class Template1e78a86664 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
?>
<ol>
<?php
		$iterations = 0;
		foreach ($items as $item) {
			?><li><?php echo LR\Filters::escapeHtmlText($item) /* line 2 */ ?></li>
<?php
			$iterations++;
		}
		?></ol><?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['item'])) trigger_error('Variable $item overwritten in foreach on line 2');
		
	}

}
