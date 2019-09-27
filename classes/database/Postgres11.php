<?php

/**
 * PostgreSQL 11 support
 *
 */

include_once('./classes/database/Postgres.php');

class Postgres11 extends Postgres {

	public $major_version = 11;

	/**
	 * Constructor
	 * @param $conn The database connection
	 */
	public function __construct($conn) {
		Postgres::__construct($conn);
	}

	// Help functions

	public function getHelpPages() {
		include_once('./help/PostgresDoc11.php');
		return $this->help_page;
	}

}

