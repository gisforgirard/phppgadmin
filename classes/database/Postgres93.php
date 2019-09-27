<?php

/**
 * PostgreSQL 9.3 support
 *
 */

include_once('./classes/database/Postgres94.php');

class Postgres93 extends Postgres94 {

	public $major_version = 9.3;

	/**
	 * Constructor
	 * @param $conn The database connection
	 */
	public function __construct($conn) {
		Postgres::__construct($conn);
	}

	// Help functions

	public function getHelpPages() {
		include_once('./help/PostgresDoc93.php');
		return $this->help_page;
	}

}

