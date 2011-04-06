<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Radio field
 *
 * @package    Kostache
 * @category   Forms
 * @author     Korney Czukowski
 * @copyright  (c) 2011 Korney Czukowski
 * @license    MIT License
 */
class Kohana_Form_Field_Radio extends Form_Field
{
	public $inline = FALSE;

	/**
	 * @param string $name
	 * @param mixed $value
	 * @param bool $checked
	 * @param array $attributes
	 * @return Form_Radio_Checkbox
	 */
	public static function factory($name, $value = NULL, $checked = FALSE, array $attributes = array())
	{
		return new Form_Field_Radio(Arr::merge(array('name' => $name, 'value' => $value, 'checked' => $checked), $attributes));
	}

	public function __construct($data)
	{
		parent::__construct($data);
		$this->id = parent::id().'-'.Text::random();
	}

	public function id()
	{
		return $this->id;
	}
}
