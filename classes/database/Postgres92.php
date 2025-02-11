<?php

/**
 * PostgreSQL 9.2 support
 *
 */

include_once('./classes/database/Postgres93.php');

class Postgres92 extends Postgres93 {

	public $major_version = 9.2;

	/**
	 * Constructor
	 * @param $conn The database connection
	 */
	public function __construct($conn) {
		Postgres::__construct($conn);
	}

	// Help functions

	public function getHelpPages() {
		include_once('./help/PostgresDoc92.php');
		return $this->help_page;
	}

}

