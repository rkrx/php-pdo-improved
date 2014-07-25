<?php
namespace Kir\PDOi\DsnFactories;

abstract class DsnFactory {
	/**
	 * @param string $uri
	 * @param array $options
	 * @return string
	 */
	public function getDsn($uri, array $options = array()) {
		$params = $this->parseDsnString($uri);
		$params = $this->getDefaults($params);
		$dsnParams = $this->defineDsnParams($params);
		$dsn = $this->buildDsnString($params['scheme'], $dsnParams);
		return $this->buildDsn($dsn, $params, $options);
	}

	/**
	 * @param string $uri
	 * @return string
	 */
	public function parseDsnString($uri) {
		$uriParts = parse_url($uri);
		$uriParts = array_merge(array('scheme' => '???', 'query' => ''), $uriParts);
		parse_str($uriParts['query'], $uriParts['query']);
		return $uriParts;
	}

	/**
	 * @param array $params
	 * @return array
	 */
	public function getDefaults(array $params = array()) {
		$defaults = array(
			'scheme' => null,
			'host' => null,
			'port' => null,
			'user' => null,
			'pass' => null,
			'path' => null,
			'query' => array(),
			'fragment' => null,
		);

		return array_merge($defaults, $params);
	}

	/**
	 * @param array $params
	 * @return array
	 */
	abstract public function defineDsnParams(array $params = array());

	/**
	 * @param string $schema
	 * @param array $params
	 * @return string
	 */
	abstract public function buildDsnString($schema, array $params = array());

	/**
	 * @param string $dsn
	 * @param array $params
	 * @param array $options
	 * @return string
	 */
	abstract public function buildDsn($dsn, array $params = array(), array $options = array());
}