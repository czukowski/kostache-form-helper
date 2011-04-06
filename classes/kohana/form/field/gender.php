<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Gender select field
 *
 * @package    Kostache
 * @category   Forms
 * @author     Korney Czukowski
 * @copyright  (c) 2011 Korney Czukowski
 * @license    MIT License
 */
class Kohana_Form_Field_Gender extends Form_Field
{
	/**
	 * @param string $name
	 * @param string $selected
	 * @param array $attributes
	 * @return Form_Field_Gender
	 */
	public static function factory($name, $selected = NULL, array $attributes = array())
	{
		return new Form_Field_Gender(Arr::merge(array(
			'name' => $name,
			'value' => Arr::overwrite(
				array(
					'' => ___('generic.gender.other'),
					'm' => ___('generic.gender.m'),
					'f' => ___('generic.gender.f'),
				), Arr::get($attributes, 'options', array())),
			'checked' => $selected,
		), $attributes));
	}

	public function __construct($data)
	{
		parent::__construct($data);
		if ($this->checked === NULL)
		{
			$this->checked = '';
		}
		$values = array();
		foreach ($this->value as $key => $value)
		{
			$values[] = array(
				'id' => parent::id().'-'.Text::random(),
				'label' => isset($this->labels[$key]) ? $this->labels[$key] : $value,
				'checked' => $this->checked == $key,
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
