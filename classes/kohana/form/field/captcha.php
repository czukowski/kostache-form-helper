<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Captcha field
 *
 * @package    Kostache
 * @category   Forms
 * @author     Korney Czukowski
 * @copyright  (c) 2011 Korney Czukowski
 * @license    MIT License
 */
class Kohana_Form_Field_Captcha extends Form_Field
{
	/**
	 * @param string $name
	 * @param array $attributes
	 * @return Form_Field_Captcha
	 */
	public static function factory($name, array $attributes = array())
	{
		return new Form_Field_Captcha(Arr::merge(array('name' => $name), $attributes));
	}

	public function captcha()
	{
		return Captcha::instance()->render();
	}

	public function label()
	{
		return __('Captcha');
	}

	public function label2()
	{
		return __('Completely Automated Public Turing test to tell Computers and Humans Apart');
	}

	public function learn_more()
	{
		return __('Learn more');
	}

	public function learn_more_url()
	{
		return ___('generic.captcha.learnmore');
	}
}
