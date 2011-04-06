<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Text field
 *
 * @package    Kostache
 * @category   Forms
 * @author     Korney Czukowski
 * @copyright  (c) 2011 Korney Czukowski
 * @license    MIT License
 */
class Kohana_Form_Field_String extends Form_Field
{
	public $rules = array();

	/**
	 * @param string $name
	 * @param mixed $value
	 * @param array $attributes
	 * @return Form_Field_String
	 */
	public static function factory($name, $value = NULL, array $attributes = array())
	{
		return new Form_Field_String(Arr::merge(array('name' => $name, 'value' => $value), $attributes));
	}

	public function maxlength()
	{
		$max_length = Arr::path($this->rules, 'max_length', array(NULL));
		return reset($max_length);
	}
}
