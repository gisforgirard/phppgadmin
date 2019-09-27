<?php

/**
 * PostgreSQL 9.4 support
 *
 */

include_once('./classes/database/Postgres.php');

class Postgres94 extends Postgres {

	public $major_version = 9.4;

	/**
	 * Constructor
	 * @param $conn The database connection
	 */
	public function __construct($conn) {
		Postgres::__construct($conn);
	}

	// Help functions

	public function getHelpPages() {
		include_once('./help/PostgresDoc94.php');
		return $this->help_page;
	}

}

