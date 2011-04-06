<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Submit button
 *
 * @package    Kostache
 * @category   Forms
 * @author     Korney Czukowski
 * @copyright  (c) 2011 Korney Czukowski
 * @license    MIT License
 */
class Kohana_Form_Field_Submit extends Form_Field
{
	/**
	 * @param string $name
	 * @param string $value
	 * @param array $attributes
	 * @return Form_Field_Submit
	 */
	public static function factory($name = NULL, $value = NULL, array $attributes = array())
	{
		return new Form_Field_Submit(Arr::merge(array('name' => $name, 'value' => $value), $attributes));
	}

	public function id()
	{
		return $this->id;
	}
}
