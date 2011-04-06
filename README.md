KOstache Form Helper
====================

This module allows you to save some time generating forms for your applications, that use Kostache. It isn't anything advanced
like [Formo](https://github.com/bmidget/kohana-formo), just a helper, even though it's more than a single class.

Basic usage
-----------

In your view file:

	public function __construct($template = NULL, array $partials = NULL)
	{
		parent::__construct($template, $partials);
		// Create form instance
		$this->form = new Form_View($this);
		// Add fields to form instance
		$this->form->add_fields(array(
			'warnings' => 'warnings',
			'username' => 'string',
			'password' => 'password',
			'remember' => 'checkbox',
			'reset' => 'link',
			'submit' => 'submit',
		), 'login');

Notes: 

* You should add fields in a view constructor as you may want your fields to add some assets to your HTML head section and that must
  be done before `Kostache::render()` is called.
* You add fields as array of `'field-name' => 'field-type'`. You can check supported field types in `classes/form/field` folder and
  their templates are in `templates/form/helper` folder. You can add your own field types by adding new files to these folders, just
  take a look how existing fields work!
* The 2nd parameter (with a value of 'login') is a fieldset name. You can have multiple fieldsets and retrieve validation errors for
  any single fieldset, see `warnings()` method below.

View file continued:

		public function password()
		{
			return $this->form->input(__FUNCTION__);
		}

		public function remember()
		{
			return $this->form->input(__FUNCTION__, 1, $this->form->defaults(__FUNCTION__, Session::instance()->get('auth_login_remember', FALSE)));
		}

Notes:

* I use `__FUNCTION__` for some arguments here so that I don't have to write field names, since they're the same as view method names.
* Accepted arguments of `$this->form->input()` vary depending on a field type. Check files in `classes/kohana/form/field`, that contain
  `factory()` method, to see how arguments must be specified for a particular field type.
* `$this->form->defaults()` return default field values, that may be set by controller, e.g.: `$this->view->form->defaults($post);`.

View file continued:

		public function reset()
		{
			return $this->form->input(__FUNCTION__, Route::url('user/profile', array('action' => 'reset')), __('Forgot password?'));
		}

		public function submit()
		{
			return $this->form->input(__FUNCTION__);
		}

		public function username()
		{
			return $this->form->input(__FUNCTION__, $this->form->defaults(__FUNCTION__));
		}

		public function warnings()
		{
			return $this->form->error('login');
		}
	}

In your view template you just mark place, where a field should appear with a partial:

	<form action="" class="cmxform" method="post" enctype="application/x-www-form-urlencoded">
		<fieldset>
			<legend>{{legend}}</legend>
			{{>warnings}}
			<ol>
				<li>{{>username}}</li>
				<li>{{>password}}</li>
				<li>{{>remember}}</li>
				<li>{{>reset}}</li>
				<li>{{>submit}}</li>
			</ol>
		</fieldset>
	</form>

In your controller:

    $this->view = Kostache::factory('user/login');
	
	try
	{
		$this->auth->login($post['username'], $post['password'], $post['remember']);
	}
	catch (Validation_Exception $e)
	{
		foreach ($e->array->errors('user/profile') as $field => $error)
		{
			$this->view->form->error($field, $error);
		}
	}

This example attempts to login a user, catches any `Validation_Exception`, retrieves their messages and adds them as form field errors.

Requirements
------------

 * [KOstache 2](https://github.com/zombor/KOstache)
 * Made for [Kohana 3.1](http://kohanaframework.org), but may work with 3.0
 * __Note__: add the module _before_ `kostache` in your `bootstrap.php` as it overrides one of its methods.