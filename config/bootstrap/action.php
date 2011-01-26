<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2010, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

/**
 * This file contains a series of method filters that allow you to intercept different parts of
 * Lithium's dispatch cycle. The filters below are used for on-demand loading of routing
 * configuration, and automatically configuring the correct environment in which the application
 * runs.
 *
 * For more information on in the filters system, see `lithium\util\collection\Filters`.
 *
 * @see lithium\util\collection\Filters
 */

use lithium\core\Libraries;
use lithium\net\http\Router;
use lithium\core\Environment;
use lithium\action\Dispatcher;
use lithium\util\collection\Filters;
use \lithium\util\Validator;
use \lithium\storage\Session;
/**
 * This filter intercepts the `run()` method of the `Dispatcher`, and first passes the `'request'`
 * parameter (an instance of the `Request` object) to the `Environment` class to detect which
 * environment the application is running in. Then, loads all application routes in all plugins,
 * loading the default application routes last.
 *
 * Change this code if plugin routes must be loaded in a specific order (i.e. not the same order as
 * the plugins are added in your bootstrap configuration), or if application routes must be loaded
 * first (in which case the default catch-all routes should be removed).
 *
 * If `Dispatcher::run()` is called multiple times in the course of a single request, change the
 * `include`s to `include_once`.
 *
 * @see lithium\action\Request
 * @see lithium\core\Environment
 * @see lithium\net\http\Router
 */
Dispatcher::applyFilter('run', function($self, $params, $chain) {
	Environment::set($params['request']);

	foreach (array_reverse(Libraries::get()) as $name => $config) {
		if ($name === 'lithium') {
			continue;
		}
		$file = "{$config['path']}/config/routes.php";
		file_exists($file) ? include $file : null;
	}
	return $chain->next($self, $params, $chain);
});
Dispatcher::applyFilter('run', function($self, $params, $chain){
	return $chain->next($self, $params, $chain);	
});
/**
 * Adds created and modified dates.
 * Updates modified if created is present.
 */
$insureDate = function($self, $params, $chain){
	$date = new \MongoDate(time());
	if(!$params['entity']->created){
		$params['entity']->created = $date;
	}
	$params['entity']->modified = $date;
	return $chain->next($self, $params, $chain);
};
/**
 * Add the default state to the document.
 * static::defaultState() must be defined.
 */
$insureDefaultState = function($self, $params, $chain){
	$states = $self::states();
	if(!in_array($params['entity']->state, $states)){
		$params['entity']->state = $self::defaultState();
	}
	return $chain->next($self, $params, $chain);
};

Filters::apply('chowly\models\Venue', 'save', $insureDate);
Filters::apply('chowly\models\Venue', 'save', $insureDefaultState);
Filters::apply('chowly\models\Inventory', 'save', $insureDate );
Filters::apply('chowly\models\Inventory', 'save', $insureDefaultState );
Filters::apply('chowly\models\Offer', 'save', $insureDate);
Filters::apply('chowly\models\Offer', 'save', $insureDefaultState);
Filters::apply('chowly\models\Image', 'save', $insureDate);
Filters::apply('chowly\models\Purchase', 'save', $insureDate);
?>
