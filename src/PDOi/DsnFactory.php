<?php
namespace Kir\PDOi;

class DsnFactory {
	/**
	 * @param string $uri
	 * @param array $options
	 * @return Dsn
	 */
	public function createDsn($uri, array $options = array()) {
		$dsnParts = parse_url($uri);
		$dsnParts = array_merge(array('scheme' => 'sqlite'), $dsnParts);
		$dsnParts['scheme'];
		$factory = $this->getFactoryFromSchema(strtolower($dsnParts['scheme']));
		return $factory->getDsn($uri, $options);
	}

	/**
	 * @param string $scheme
	 * @return DsnFactories\DsnFactory
	 */
	private function getFactoryFromSchema($scheme) {
		$factory = null;

		switch($scheme) {
			case 'dsn':
				return new DsnFactories\DsnDsnFactory();
			case 'pgsql':
				return new DsnFactories\PgsqlDsnFactory();
			case 'mysql':
				return new DsnFactories\MysqlDsnFactory();
			case 'sqlite':
			case 'sqlite2':
			case 'sqlite3':
				return new DsnFactories\SqliteDsnFactory();
			default:
		}
		return new DsnFactories\DefaultDsnFactory();
	}
} 