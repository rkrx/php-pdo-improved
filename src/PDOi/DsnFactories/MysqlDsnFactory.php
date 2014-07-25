<?php
namespace Kir\PDOi\DsnFactories;

use arr;
use Kir\PDOi\Dsn;

class MysqlDsnFactory extends PgsqlDsnFactory {
	/**
	 * @param array $params
	 * @return array
	 */
	public function defineDsnParams(array $params = array()) {
		$dsnParams = parent::defineDsnParams($params);
		$dsnParams = arr\diffKeys($dsnParams, array('user', 'pass'));
		if($params['host'] === null) {
			if($params['path'] !== '/' && $params['path'] !== null) {
				$dsnParams['unix_socket'] = $params['path'];
			}
		}
		return $dsnParams;
	}

	/**
	 * @param string $dsn
	 * @param array $params
	 * @param array $options
	 * @return string
	 */
	public function buildDsn($dsn, array $params = array(), array $options = array()) {
		return new Dsn($dsn, $params['user'], $params['pass'], $options);
	}
}