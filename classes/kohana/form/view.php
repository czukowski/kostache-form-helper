<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Main Kostache Form Helper class
 *
 * @package    Kostache
 * @category   Forms
 * @author     Korney Czukowski
 * @copyright  (c) 2011 Korney Czukowski
 * @license    MIT License
 */
class Kohana_Form_View
{
	/**
	 * @var array
	 */
	protected static $_templates = array();

	/**
	 * @var Kostache
	 */
	protected $_view;

	/**
	 * @var array
	 */
	protected $_fields = array();

	/**
	 * @var array
	 */
	protected $_fieldsets = array();

	/**
	 * @var array
	 */
	protected $_errors = array();

	/**
	 * @var array
	 */
	protected $_defaults = array();

	/**
	 * @var bool
	 */
	public $errors = FALSE;

	/**
	 * Constructor
	 * @param Kostache $view
	 */
	public function __construct(Kostache $view)
	{
		$this->_view = $view;
	}

	/**
	 * Adds form fields and partials for field names to the current view
	 * @param mixed $field_name
	 * @param string $template
	 * @param string $fieldset
	 * @return Form_View
	 */
	public function add_fields($field_name, $template = NULL, $fieldset = NULL)
	{
		if ( ! is_array($field_name))
		{
			$field_name = array($field_name => $template);
		}
		else
		{
			$fieldset = $template;
		}
		foreach ($field_name as $field => $template)
		{
			$this->_fields[$field] = $template;
			$this->_view->partial($field, self::partial($field, $template));
			if ($fieldset !== NULL)
			{
				$this->_fieldsets[$field] = $fieldset;
			}
		}
		return $this;
	}

	/**
	 * Gets or sets defaults array
	 * @param mixed $field
	 * @param mixed $default
	 * @return mixed
	 */
	public function defaults($field = NULL, $default = NULL)
	{
		if ($field === NULL)
		{
			return $this->_defaults;
		}
		elseif (is_string($field))
		{
			return Arr::path($this->_defaults, $field, $default);
		}
		$this->_defaults = $field;
	}

	/**
	 * Sets or gets errors
	 * @param mixed $field
	 * @param mixed $error
	 * @param mixed $fieldset
	 * @return mixed
	 */
	public function error($field = NULL, $error = NULL, $fieldset = NULL)
	{
		if (is_array($field))
		{
			// Assume $field is instance or array of instances of Form_Error
			$field = (array) $field;
			foreach ($field as $entry)
			{
				$this->_add_error($entry->field, $entry->text, $error);
			}
		}
		elseif ($field !== NULL AND $error !== NULL)
		{
			// Assume field and error are strings
			$this->_add_error($field, $error, $fieldset);
		}
		elseif ($field !== NULL AND $error === NULL)
		{
			// Return errors from a fieldset
			return Arr::get($this->_errors, $field);
		}
		else
		{
			// Return all errors
			return $this->_errors;
		}
		$this->errors = TRUE;
		return $this;
	}

	/**
	 * Returns fieldsets
	 */
	public function get_fieldsets()
	{
		return $this->_fieldsets;
	}

	/**
	 * Returns object to feed to form field partial
	 * @param string $field_name
	 * @return object
	 */
	public function input($field_name)
	{
		$arguments = func_get_args();
		return call_user_func_array('Form_Field_'.self::field_type($this->_fields[$field_name]).'::factory', $arguments);
	}

	/**
	 * Removes error, that was set earlier
	 * @param string $field_name
	 * @return Form_View
	 */
	public function remove_error($field_name)
	{
		foreach ($this->_errors as $fieldset_errors)
		{
			$fieldset_errors->erase($field_name);
		}
		return $this;
	}

	/**
	 * Adds a single error to specified fieldset
	 * @param mixed $error - string or Form_Error
	 * @param mixed $error - string or NULL
	 * @param string $fieldset - string or NULL
	 * @return Form_Error_Fieldset
	 */
	protected function _add_error($field, $text = NULL, $fieldset = NULL)
	{
		if ($fieldset === NULL)
		{
			$fieldset = Arr::get($this->_fieldsets, $field instanceof Form_Error ? $field->field : $field, 'default');
		}
		if ( ! array_key_exists($fieldset, $this->_errors))
		{
			$this->_errors[$fieldset] = new Form_Error_Fieldset($fieldset);
		}
		$this->_errors[$fieldset]->set($field, $text);
		return $this->_errors[$fieldset];
	}

	/**
	 * @param string
	 * @return string
	 */
	public static function field_type($template)
	{
		return (($pos = strpos($template, '/')) !== FALSE) ? substr($template, $pos + 1) : $template;
	}

	/**
	 * Creates partials to use with Mustache
	 * This example adds a string partial (text input):
	 *
	 *     $this->_partials['somefield'] = Form_View::partial('some_field', 'string');
	 *
	 * Then you have:
	 *
	 *     public function somefield()
	 *     {
	 *         return Form_Field_String::factory('some_field', 'Some Value');
	 *     }
	 *
	 * @param string $name
	 * @param string $type
	 * @return string
	 */
	public static function partial($name, $type)
	{
		if ( ! isset(self::$_templates[$type]))
		{
			if ( ! ($template = Kohana::find_file('templates', 'form/helper/'.$type, 'mustache')))
			{
				throw new Kohana_Exception('Template not found: templates/form/helper/'.$type.'.mustache');
			}
			self::$_templates[$type] = file_get_contents($template);
			Form_Hook::add_field_type(self::field_type($type));
		}
		return '{{#'.$name.'}}'.self::$_templates[$type].'{{/'.$name.'}}';
	}
}