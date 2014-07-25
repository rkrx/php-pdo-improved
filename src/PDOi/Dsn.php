<?php
namespace Kir\PDOi;


class Dsn {
	private $dsn;
	private $user;
	private $pass;
	/**
	 * @var array
	 */
	private $params;

	/**
	 * @param string $dsn
	 * @param string $user
	 * @param string $pass
	 * @param array $params
	 */
	public function __construct($dsn, $user, $pass, array $params = array()) {
		$this->dsn = $dsn;
		$this->user = $user;
		$this->pass = $pass;
		$this->params = $params;
	}

	/**
	 * @return string
	 */
	public function getDsn() {
		return $this->dsn;
	}

	/**
	 * @return array
	 */
	public function getParams() {
		return $this->params;
	}

	/**
	 * @return string
	 */
	public function getPass() {
		return $this->pass;
	}

	/**
	 * @return string
	 */
	public function getUser() {
		return $this->user;
	}
}