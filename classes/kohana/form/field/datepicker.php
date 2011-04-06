<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Datepicker field
 *
 * @package    Kostache
 * @category   Forms
 * @author     Korney Czukowski
 * @copyright  (c) 2011 Korney Czukowski
 * @license    MIT License
 */
class Kohana_Form_Field_Datepicker extends Form_Field
{
	public $maxlength = 20;
	public $options = array(
		'can_always_go_up' => array('month', 'days'),
		'draggable' => FALSE,
		'format' => NULL,
		'label_date_format' => NULL,	// Lustr-specific
		'min_date' => NULL,
		'max_date' => NULL,
		'pick_only' => FALSE,
		'picker_class' => 'datepicker-lustr tooltip',
		'picker_position' => 'topRight',
		'position_offset' => array('x' => 11, 'y' => -5),
		'start_view' => 'days',
		'time_picker' => FALSE,
		'time_wheel_step' => 1,
		'use_fade_in_out' => FALSE,
		'year_picker' => TRUE,
		'year_per_page' => 20,
	);

	/**
	 * @param string $name
	 * @param mixed $value
	 * @param array $options
	 * @param array $attributes
	 * @return Form_Field_Datepicker
	 */
	public static function factory($name, $value = NULL, array $options = array(), array $attributes = array())
	{
		return new Form_Field_Datepicker(Arr::merge(array('name' => $name, 'value' => $value, 'options' => $options), $attributes));
	}

	public function __construct($data)
	{
		$data['options'] = Arr::overwrite($this->options, $data['options']);
		parent::__construct($data);
	}

	public function options_json()
	{
		return json_encode($this->options);
	}
}