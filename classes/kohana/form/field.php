<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Base class for form field element
 *
 * @package    Kostache
 * @category   Forms
 * @author     Korney Czukowski
 * @copyright  (c) 2011 Korney Czukowski
 * @license    MIT License
 */
class Kohana_Form_Field
{
	public function __construct(array $data)
	{
		$data = Arr::merge(array(
			'name' => '',
			'value' => '',
			'class' => NULL,
		), $data);
		if ( ! isset($data['label']))
		{
			$data['label'] = UTF8::ucfirst(Inflector::humanize($data['name']));
		}
		foreach ($data as $property => $value)
		{
			$this->$property = $value;
		}
	}

	public function __get($key)
	{
		return NULL;
	}

	public function id()
	{
		return 'field-'.preg_replace('#[^a-z0-9_-]#ui', '', $this->name);
	}

	public function label()
	{
		return __($this->label);
	}
}