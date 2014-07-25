<?php
namespace Kir\PDOi\DsnFactories;

use arr;
use Kir\PDOi\Dsn;

class PgsqlDsnFactory extends DefaultDsnFactory {
	/**
	 * @param array $params
	 * @return array
	 */
	public function getDefaults(array $params = array()) {
		$params = parent::getDefaults($params);
		$params['query'] = array_merge(array('charset' => 'utf8'), $params['query']);
		return $params;
	}

	/**
	 * @param array $params
	 * @return array
	 */
	public function defineDsnParams(array $params = array()) {
		$dsnParams = parent::defineDsnParams($params);

		if($params['user'] !== null) {
			$dsnParams['user'] = $params['user'];
		}

		if($params['pass'] !== null) {
			$dsnParams['pass'] = $params['pass'];
		}

		return $dsnParams;
	}

	/**
	 * @param string $schema
	 * @param array $params
	 * @return string
	 */
	public function buildDsnString($schema, array $params = array()) {
		$params = arr\mapKeysAndValues($params, function ($key, $value) {
			return "{$key}={$value}";
		});
		$dsnQuery = join(';', $params);
		return "{$schema}:{$dsnQuery}";
	}

	/**
	 * @param string $dsn
	 * @param array $params
	 * @param array $options
	 * @return string
	 */
	public function buildDsn($dsn, array $params = array(), array $options = array()) {
		return new Dsn($dsn, null, null);
	}
}