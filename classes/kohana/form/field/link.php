<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Form link
 *
 * @package    Kostache
 * @category   Forms
 * @author     Korney Czukowski
 * @copyright  (c) 2011 Korney Czukowski
 * @license    MIT License
 */
class Kohana_Form_Field_Link extends Form_Field
{
	/**
	 * @param string $name
	 * @param mixed $value
	 * @param array $attributes
	 * @return Form_Field_Link
	 */
	public static function factory($name, $url, $text, array $attributes = array())
	{
		return new Form_Field_Link(Arr::merge(array('name' => $name, 'url' => $url, 'text' => $text), $attributes));
	}

	public function id()
	{
		return $this->id;
	}
}
