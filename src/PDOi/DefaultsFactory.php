<?php
namespace Kir\PDOi;

class DefaultsFactory {
	/**
	 * PostgreSQL
	 *
	 * @param array $params
	 * @return array
	 */
	public static function getDefaultsForPgsql($params) {
		$params = self::getDefaults($params);

		return $params;
	}

	/**
	 * MySQL
	 *
	 * @param array $params
	 * @return array
	 */
	public static function getDefaultsForMysql($params) {
		$params = self::getDefaults($params);
		$params = self::getDefaultsForPgsql($params);
		return $params;
	}

	/**
	 * MySQL
	 *
	 * @param array $params
	 * @return array
	 */
	public static function getDefaultsForSqlite($params) {
		$params = self::getDefaults($params);
		return $params;
	}
}