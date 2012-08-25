<?php

namespace FourChimps\TwigExtensionBundle\Extension;
use Twig_Extension as BaseTwig_Extension;

class TwigExtension extends BaseTwig_Extension {

	public function getFilters() {
		return array(
				'var_dump' => new \Twig_Filter_Function('var_dump'),
				'highlight' => new \Twig_Filter_Method($this, 'highlight'),
				'uncamelcase' => new \Twig_Filter_Method($this, 'inverseCamelCase'));
	}

	public function highlight($sentence, $expr) {
		return preg_replace('/(' . $expr . ')/',
				'<span style="color:red">\1</span>', $sentence);
	}

	public function inverseCamelCase($string) {
		return ucfirst(
				   trim(
					 preg_replace('/(?!^)[[:upper:]][[:lower:]]/', ' $0',
					  preg_replace('/(?!^)[[:upper:]]+/', ' $0',
										$string))));
	}

	public function getName() {
		return 'fourchimps_twig_extension';
	}

}
