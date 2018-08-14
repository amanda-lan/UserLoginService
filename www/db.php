<?php

class DB {

	private static $servername;
	private static $username;
	private static $password;
	private static $dbname;
	private static $charset;
	private static $conn;
	private static $statement;

	private static function pdoconnect() {
		self::$servername = "localhost";
		self::$username = "root";
		self::$password = "lw0105~LW";
		self::$dbname = "UserLoginDB";
		self::$charset = "utf8mb4";

		try {
			$dsn = "mysql:host=" . self::$servername . ";dbname=" . self::$dbname . ";charset=" . self::$charset;
			$pdo = new PDO($dsn, self::$username, self::$password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			echo "Connection successfully" . "<br>";
			return $pdo;
		} catch (PDOException $e) {
			echo "Connection failed; " . $e->getMessage();
		}

	}

	public static function queryUser($sql, $condition, $parameter) {
		self::$conn = self::pdoconnect();
		self::$statement = self::$conn->prepare($sql . $condition);
		self::$statement->bindParam($condition, $parameter);
		self::$statement->execute();
		return self::$statement->fetchAll();
	}

	public static function insertNewUser($u_name, $hashed_password, $u_cpassword) {
		self::$conn = self::pdoconnect();
		self::$statement = self::$conn->prepare("INSERT INTO Users (Username, Password, CPassword) VALUES(:u_name, :u_Password, :u_CPassword)");
		self::$statement->bindParam(':u_name', $u_name);
		self::$statement->bindParam(':u_Password', $hashed_password);
		self::$statement->bindParam(':u_CPassword', $u_cpassword);
		self::$statement->execute();
	}
}
