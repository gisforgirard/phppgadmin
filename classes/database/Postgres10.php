<?php

/**
 * PostgreSQL 10 support
 *
 */

include_once('./classes/database/Postgres11.php');

class Postgres10 extends Postgres11 {

	public $major_version = 10;

	/**
	 * Constructor
	 * @param $conn The database connection
	 */
	public function __construct($conn) {
		Postgres::__construct($conn);
	}

	// Help functions

	public function getHelpPages() {
		include_once('./help/PostgresDoc10.php');
		return $this->help_page;
	}

}

