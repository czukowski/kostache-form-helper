<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Password field
 *
 * @package    Kostache
 * @category   Forms
 * @author     Korney Czukowski
 * @copyright  (c) 2011 Korney Czukowski
 * @license    MIT License
 */
class Kohana_Form_Field_Password extends Form_Field_String
{
	/**
	 * @param string $name
	 * @param mixed $value
	 * @param array $attributes
	 * @return Form_Field_Password
	 */
	public static function factory($name, $value = NULL, array $attributes = array())
	{
		return new Form_Field_Password(Arr::merge(array('name' => $name, 'value' => $value), $attributes));
	}
}