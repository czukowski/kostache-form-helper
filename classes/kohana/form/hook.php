<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Base class to hook a custom code (events-like)
 *
 * @package    Kostache
 * @category   Forms
 * @author     Korney Czukowski
 * @copyright  (c) 2011 Korney Czukowski
 * @license    MIT License
 */
class Kohana_Form_Hook
{
	/**
	 * This function is called every time a new field type is added to form.
	 * May be useful to add any custom assets to page head.
	 * 
	 * @param string $type
	 */
	public static function add_field_type($type)
	{
		// Nothing by default
	}
}
