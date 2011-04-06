<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Colorpicker field
 *
 * @package    Kostache
 * @category   Forms
 * @author     Korney Czukowski
 * @copyright  (c) 2011 Korney Czukowski
 * @license    MIT License
 */
class Kohana_Form_Field_Colorpicker extends Form_Field
{
	/**
	 * @param string $name
	 * @param mixed $value
	 * @param array $attributes
	 * @return Form_Field_Colorpicker
	 */
	public static function factory($name, $value = NULL, array $attributes = array())
	{
		return new Form_Field_Colorpicker(Arr::merge(array('name' => $name, 'value' => $value), $attributes));
	}

	public function img_blank()
	{
		return URL::site('images/lustr/blank.png');
	}

	public function select_color()
	{
		return ___('Select color');
	}
}
