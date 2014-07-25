<?php
namespace Kir\PDOi;

class DsnFactory {
	/**
	 * @param string $uri
	 * @param array $options
	 * @return Dsn
	 */
	public function createDsn($uri, array $options = array()) {
		$uriParts = parse_url($uri);
		$uriParts = array_merge(array('scheme' => 'sqlite', 'query' => ''), $uriParts);
		parse_str($uriParts['query'], $uriParts['query']);
		$factory = $this->getFactoryFromSchema(strtolower($uriParts['scheme']));
		return $factory->getDsn($uriParts, $options);
	}

	/**
	 * @param string $scheme
	 * @param array $params
	 * @param array $options
	 * @return DsnFactories\DsnFactory
	 */
	private function getFactoryFromSchema($scheme) {
		$factory = null;

		switch($scheme) {
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