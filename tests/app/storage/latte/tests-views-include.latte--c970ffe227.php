<?php
// source: /media/pc/Data/Projects/opis-colibri/latte/tests/views/include.latte

use Latte\Runtime as LR;

class Templatec970ffe227 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
		?>Including <?php echo LR\Filters::escapeHtmlText($file) /* line 1 */ ?>

<?php
		/* line 2 */
		$this->createTemplate($file, $this->params, "include")->renderToContentType('html');
		return get_defined_vars();
	}

}
