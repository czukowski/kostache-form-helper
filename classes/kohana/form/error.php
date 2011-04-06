<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Container class for single form error message
 *
 * @package    Kostache
 * @category   Forms
 * @author     Korney Czukowski
 * @copyright  (c) 2011 Korney Czukowski
 * @license    MIT License
 */
class Kohana_Form_Error
{
	/**
	 * Error message
	 * @var string
	 */
	public $text;
	/**
	 * Field name
	 * @var string
	 */
	public $field;

	/**
	 * Class constructor
	 * @param string $field
	 * @param string $text
	 */
	public function __construct($field, $text)
	{
		$this->text = UTF8::ucfirst($text);
		$this->field = $field;
	}
}
