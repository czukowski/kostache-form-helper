<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Error group container class, i.e. errors for a specific fieldset
 *
 * @package    Kostache
 * @category   Forms
 * @author     Korney Czukowski
 * @copyright  (c) 2011 Korney Czukowski
 * @license    MIT License
 */
class Kohana_Form_Error_Fieldset
{
	public $count = 0;
	public $errors = array();
	public $name;

	/**
	 * Class constructor
	 * @param string $name
	 */
	public function __construct($name)
	{
		$this->name = $name;
	}

	/**
	 * Returns TRUE if there are errors
	 * @return bool
	 */
	public function not_empty()
	{
		return ! empty($this->errors);
	}

	/**
	 * Deletes specific or all errors
	 * @param string $field or NULL
	 */
	public function erase($field = NULL)
	{
		if ($field === NULL)
		{
			$this->errors = array();
			$this->count = 0;
		}
		else
		{
			$remaining = array();
			foreach ($this->errors as $error)
			{
				if ($error->field == $field)
				{
					$this->count--;
				}
				else
				{
					$remaining[] = $error;
				}
			}
			$this->errors = $remaining;
		}
		return $this;
	}

	/**
	 * Gets fieldset errors
	 * @param string $field
	 * @return array
	 */
	public function get($field = NULL)
	{
		if (is_string($field))
		{
			// Select and return errors for a specific field
			$result = array();
			foreach ($this->errors as $error)
			{
				if ($error->field == $field)
				{
					$result[] = $error;
				}
			}
			return $result;
		}
		else
		{
			// Return all errors
			return $this->errors;
		}
	}

	/**
	 * Sets fieldset error(s)
	 * @param mixed - string or Form_Error instance
	 * @param mixed - string or NULL
	 * @return Form_Error
	 */
	public function set($field = NULL, $message = NULL)
	{
		// Set errors
		if ( ! ($field instanceof Form_Error))
		{
			$field = new Form_Error($field, $message);
		}
		$this->errors[] = $field;
		$this->count++;
		return $field;
	}
}