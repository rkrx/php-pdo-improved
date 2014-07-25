<?php
namespace Kir\PDOi\DsnFactories;

use arr;

class DsnDsnFactory extends DefaultDsnFactory {
	/**
	 * @param string $uri
	 * @return string
	 */
	public function parseDsnString($uri) {
		list(, $scheme, $paramStr) = array_merge(explode(':', $uri, 3), array('', ''));
		$params = explode(';', $paramStr);
		$params = arr\mapKeysAndValues($params, function (&$key, $value) {
			if(strpos($value, '=') !== false) {
				list($key, $value) = explode('=', $value, 2);
			}
			return $value;
		});
		$params = array_merge(array('username' => null, 'password' => null), $params);
		$query = arr\diffKeys($params, array('username', 'password'));
		return array(
			'scheme' => $scheme,
			'user' => $params['username'],
			'pass' => $params['password'],
			'query' => $query
		);
	}
}