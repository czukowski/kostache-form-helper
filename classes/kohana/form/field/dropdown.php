<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Dropdown field
 *
 * @package    Kostache
 * @category   Forms
 * @author     Korney Czukowski
 * @copyright  (c) 2011 Korney Czukowski
 * @license    MIT License
 */
class Kohana_Form_Field_Dropdown extends Form_Field
{
	public $classes = array();
	public $disabled = array();

	/**
	 * @param string $name
	 * @param array $options
	 * @param string $selected
	 * @param array $attributes
	 * @return Form_Field_Dropdown
	 */
	public static function factory($name, $options = array(), $selected = NULL, array $attributes = array())
	{
		return new Form_Field_Dropdown(Arr::merge(array('name' => $name, 'value' => $options, 'checked' => $selected), $attributes));
	}

	public function __construct($data)
	{
		parent::__construct($data);
		$values = array();
		foreach ($this->value as $key => $value)
		{
			$values[] = array(
				'class' => isset($this->classes[$key]) ? $this->classes[$key] : NULL,
				'disabled' => in_array($key, $this->disabled),
				'data_aux' => isset($this->data_aux[$key]) ? $this->data_aux[$key] : NULL,
				'label' => isset($this->labels[$key]) ? $this->labels[$key] : $value,
				'selected' => $this->checked == $key,
				'value' => $key,
			);
		}
		$this->value = $values;
	}

	public function options()
	{
		return $this->value;
	}
}
