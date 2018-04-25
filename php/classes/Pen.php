<?php
/**
 * Created by PhpStorm.
 * User: marlon
 * Date: 4/24/18
 * Time: 6:17 PM
 */

class Pen {


	/** PENS
	 *
	 * inserts new pen into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public function insert(\PDO $pdo) : void {

// create query template
		$query = "INSERT INTO pen(penId, penProfileId, penCssContent, penHtmlContent, penJsContent, penName) VALUES (:penId, :penProfileId, :penCssContent, :penHtmlContent, :penJsContent, :penName)";
		$statement = $pdo->prepare($query);

// bind the member variables to the placeholders in the template
		$parameters = ["penProfileId" => $this->penProfileId->getBytes(), "penId" => $this->penId->getBytes(), "penName" => $this->penName, "penHtmlContent" => $this->penHtmlContent, "penCssContent" => $this->penCssContent, "penJsContent" => $this->penJsContent];
		$statement->execute($parameters);
	}

	/** deletes this pen from mysql
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public function delete(\PDO $pdo) : void {

// create query template
		$query = "DELETE FROM pen WHERE penId = :penId";
		$statement = $pdo->prepare($query);

// bind member vars to placeholder in template
		$parameters = ["penId" => $this->penId->getBytes()];
		$statement->execute($parameters);
	}

	/** updates this pen in mysql
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public function update(\PDO $pdo) : void {

// create query template
		$query = "UPDATE pen SET penName = :penName, penHtmlContent = :penHtmlContent, penCssContent = :penCssContent, penJsContent = :penJsContent WHERE penId = :penId";
		$statement = $pdo->prepare($query);

		$parameters = ["penId" => $this->penId->getBytes(), "penName" => $this->penName, "penHtmlContent" => $this->penHtmlContent, "penCssContent" => $this->penCssContent, "penJsContent" => $this->penJsContent];
		$statement->execute($parameters);

	}