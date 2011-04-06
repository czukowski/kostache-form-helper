<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Checkbox field
 *
 * @package    Kostache
 * @category   Forms
 * @author     Korney Czukowski
 * @copyright  (c) 2011 Korney Czukowski
 * @license    MIT License
 */
class Kohana_Form_Field_Checkbox extends Form_Field
{
	/**
	 * @param string $name
	 * @param mixed $value
	 * @param bool $checked
	 * @param array $attributes
	 * @return Form_Field_Checkbox
	 */
	public static function factory($name, $value = NULL, $checked = FALSE, array $attributes = array())
	{
		return new Form_Field_Checkbox(Arr::merge(array('name' => $name, 'value' => $value, 'checked' => $checked), $attributes));
	}

	public function __construct($data)
	{
		parent::__construct($data);
		if ( ! isset($data['label2']))
		{
			$this->label2 = 'Yes';
		}
		else
		{
			$this->label_class = 'auto';
		}

	}

	public function label2()
	{
		return __($this->label2);
	}
}