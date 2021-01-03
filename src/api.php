<?php
	class Connection {
		# vars
		private $mysqli;
		# constructor
		function __construct($host = 'localhost', $user = 'root', $password = '', $database = 'default') {
			# connect to database or have the value of a error
			$this->mysqli = new mysqli($host, $user, $password, $database) or die(mysqli_error());
		}
		# functions
		function prevent($value) {
			# to no heve sql inject
			return mysqli_escape_string($this->mysqli, $value);
		}

		function close() {
			$this->mysqli->close();
		}

		function select($from, $which = '*', $where = null) {
			$return = ($where != null) ? $this->mysqli->query("SELECT $which FROM $from WHERE $where;") : $this->mysqli->query("SELECT $which FROM $from");

			return $return;
		}

		function nextResult($result) {
			$return = (gettype($result) != "boolean") ? $result->fetch_assoc() : false;
			return $return;
		}

		function numRows($result) {
			return mysqli_num_rows($result);
		}
	}
?>