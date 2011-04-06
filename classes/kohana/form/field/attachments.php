<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Attachments field
 *
 * @package    Kostache
 * @category   Forms
 * @author     Korney Czukowski
 * @copyright  (c) 2011 Korney Czukowski
 * @license    MIT License
 */
class Kohana_Form_Field_Attachments extends Form_Field
{
	public $files = array();

	/**
	 * @param string $name
	 * @param array $files
	 * @param array $attributes
	 * @return Form_Field_Attachments
	 */
	public static function factory($name, $files = array(), array $attributes = array())
	{
		return new Form_Field_Attachments(Arr::merge(array('value' => $files, 'name' => $name), $attributes));
	}

	public function __construct($data)
	{
		if ( ! isset($data['button_label']))
		{
			$data['button_label'] = 'Attach files';
		}
		if ( ! isset($data['upload_url']))
		{
			$data['upload_url'] = Route::url('user/profile', array('action' => 'upload'));
		}
		if ( ! isset($data['update_url']))
		{
			$data['update_url'] = Route::url('user/profile', array('action' => 'uploads'));
		}
		if ($data['value'])
		{
			$this->files = Model::factory('file')->find_in( (array) $data['value']);
		}
		$this->blank_img = Lustr::blank_img();
		$this->__remove = ___('Remove');
		parent::__construct($data);
	}

	public function button_label()
	{
		return ___($this->button_label);
	}

	public function li_class()
	{
		return ( (bool) $this->value) ? '' : 'hidden';
	}
}
