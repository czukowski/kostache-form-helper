<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Button field
 *
 * @package    Kostache
 * @category   Forms
 * @author     Korney Czukowski
 * @copyright  (c) 2011 Korney Czukowski
 * @license    MIT License
 */
class Kohana_Form_Field_Button extends Form_Field
{
	/**
	 * @param string $name
	 * @param array $attributes
	 * @return Form_Field_Button
	 */
	public static function factory($name, array $attributes = array())
	{
		return new Form_Field_Button(Arr::merge(array('name' => $name), $attributes));
	}
}
