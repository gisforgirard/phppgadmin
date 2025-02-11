<?php

/**
 * PostgreSQL 9.0 support
 *
 * $Id: Postgres82.php,v 1.10 2007/12/28 16:21:25 ioguix Exp $
 */

include_once('./classes/database/Postgres91.php');

class Postgres90 extends Postgres91 {

	public $major_version = 9.0;

	/**
	 * Constructor
	 * @param $conn The database connection
	 */
	public function __construct($conn) {
		Postgres::__construct($conn);
	}

	// Help functions

	public function getHelpPages() {
		include_once('./help/PostgresDoc90.php');
		return $this->help_page;
	}

	// Capabilities

}

