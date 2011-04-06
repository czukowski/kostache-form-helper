<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Textarea field
 *
 * @package    Kostache
 * @category   Forms
 * @author     Korney Czukowski
 * @copyright  (c) 2011 Korney Czukowski
 * @license    MIT License
 */
class Kohana_Form_Field_Textarea extends Form_Field
{
	public $cols = 48;
	public $rows = 5;

	/**
	 * @param string $name
	 * @param mixed $value
	 * @param array $attributes
	 * @return Form_Field_Textarea
	 */
	public static function factory($name, $text = NULL, array $attributes = array())
	{
		return new Form_Field_Textarea(Arr::merge(array('name' => $name, 'value' => $text), $attributes));
	}
}
