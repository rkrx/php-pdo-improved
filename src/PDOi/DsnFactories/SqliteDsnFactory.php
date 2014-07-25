<?php
namespace Kir\PDOi\DsnFactories;

use arr;
use Kir\PDOi\Dsn;

class SqliteDsnFactory extends DsnFactory {
	/**
	 * @param array $params
	 * @return array
	 */
	public function defineDsnParams(array $params = array()) {
		$dsnParams = $params['query'];

		if($params['host'] !== null) {
			$dsnParams['host'] = $params['host'];

			if($params['port'] !== null) {
				$dsnParams['port'] = $params['port'];
			}
		}

		if($params['fragment'] !== null) {
			$dsnParams['dbname'] = $params['fragment'];
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
		return new Dsn($dsn, null, null, $options);
	}
}