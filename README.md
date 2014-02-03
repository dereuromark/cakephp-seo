# Seo Plugin

SEO and meta tag handling the clean and easy way.

## Background

We needed a plugin to work with SEO in a way that it is both DRY and easy to maintain.
The original repo name was Sham, but we liked Seo a lot better.

## Requirements

* PHP 5.2.6+
* CakePHP 2.x

## Installation

### Manual

* Download this: http://github.com/dereuromark/cakephp-seo/zipball/master
* Unzip that download.
* Copy the resulting folder to app/Plugin
* Rename the folder you just copied to `Seo`

### GIT Submodule

In your app directory type:
```
git submodule add git://github.com/dereuromark/cakephp-seo.git Plugin/Seo
git submodule init
git submodule update
```

### GIT Clone

In your plugin directory type
```
git clone git://github.com/dereuromark/cakephp-seo.git Seo
```

## Usage

Add the component to your AppController $components and $helpers arrays:

```<?php
class AppController extends Controller {
	public $components = array('Seo.Seo');
	public $helpers = array('Seo.Seo');
}
?>
```

By default, Seo does not automatically load SEO data from the database. You should create
callbacks in your controllers to do that. Callbacks are on a per-action basis, with `_seo`
prepending the name of the action, where the first letter of the action is upper-cased:

```<?php
class UsersController extends AppController {

	public function profile($username = null) {
		// Some code that works with user profiles
	}

	public function _seoProfile() {
		// Called in the beforeRender() if the action was successfully processed
		$user = $this->viewVars['user'];
		$this->Seo->loadBySlug('view/' . $user['User']['username']);

		// Set some defaults in case the record could not be loaded from the DB
		$description = "awesome description of the page, with some good default keywords, referencing {$user['User']['username']}";
		$keywords = array($user['User']['username'] . ' profile', 'profiles', 'social network');

		$this->Seo->setMeta('title', "{$user['User']['username']}'s Profile  | Social Network");
		$this->Seo->setMeta('description', $description);
		$this->Seo->setMeta('keywords', implode(', ', $keywords));
		$this->Seo->setMeta('canonical', "/view/{$user['User']['username']}/", array('escape' => false));
	}
}
?>
```

If you do not have a callback for a given action, there is always the option of specifying a
"fallback" method. This is configurable in the components settings, but is `Controller::_seoFallback()`
by default:

```php
class AppController extends Controller {
	public $components = array('Seo.Meta');
	public $helpers = array('Seo.Meta');

	public function _seoFallback() {
		// ... code ...
	}
}
```

Finally, there is also a `Controller::_seoAfterMeta()` callback which will be triggered after
all others.

Once you've loaded seo data, it's time to set it for the view. Included is a `SeoHelper`
which automatically will deal with these details:

```
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php echo $this->Seo->out('charset'); ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<?php echo $this->Seo->out(null, array('skip' => array('charset'))); ?>
		<?php echo $this->Html->css(array('style', 'uniform.default')); ?>
	<head>
	<body>
		...
	</body>
</html>
```

As you can see, we can call individual SEO information - in this case the charset - if necessary,
and then call the rest by passing `null` as an option to the helper.
This is useful in some cases where you might need to have the SEO data in a specific order.

## Todo

* Document Helper and Component options

## License

Sham to Seo: dereuromark

Original Copyright:

Copyright (c) 2011 Jose Diaz-Gonzalez

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
