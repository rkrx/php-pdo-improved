<?php
namespace Kir;

use PDO;
use Kir\PDOi\DsnFactory;

class PDOi extends PDO {
	/**
	 * @param string $uri
	 * @param array $params
	 * @param DsnFactory $dsnFactory
	 */
	public function __construct($uri, array $params = array(), DsnFactory $dsnFactory = null) {
		if(!$dsnFactory) {
			$dsnFactory = new DsnFactory();
		}
		$dsn = $dsnFactory->createDsn($uri, $params);
		parent::__construct($dsn->getDsn(), $dsn->getUser(), $dsn->getPass(), $dsn->getParams());
		$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
}