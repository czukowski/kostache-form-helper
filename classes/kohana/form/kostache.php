<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Kostache class modification to make literal partials work
 *
 * @package    Kostache
 * @category   Forms
 * @author     Korney Czukowski
 * @copyright  (c) 2011 Korney Czukowski
 * @license    MIT License
 */
class Kohana_Form_Kostache extends Kohana_Kostache
{
	/**
	 * Loads a new partial from a path. If the path is empty, the partial will
	 * be removed. If the path does not exist, partial will be added literally
	 * @see https://github.com/zombor/KOstache/issues/closed#issue/15
	 *
	 * @param   string  partial name
	 * @param   mixed   partial path, FALSE to remove the partial
	 * @return  Kostache
	 */
	public function partial($name, $path)
	{
		if ( ! $path)
		{
			unset($this->_partials[$name]);
		}
		else
		{
			try
			{
				// Load partial template from file
				$this->_partials[$name] = $this->_load($path);
			}
			catch (Kohana_Exception $e)
			{
				// Add partial literally, if above failed
				$this->_partials[$name] = $path;
			}
		}

		return $this;
	}
}
