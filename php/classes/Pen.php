<?php
/**
 * Created by PhpStorm.
 * User: marlon
 * Date: 4/24/18
 * Time: 6:17 PM
 */
use Ramsey\Uuid\Uuid;

class Pen {

	trait ValidateUuid {
		/**
		 * validates a uuid irrespective of format
		 *
		 * @param string|Uuid $newUuid uuid to validate
		 * @return Uuid object with validated uuid
		 * @throws \InvalidArgumentException if $newUuid is not a valid uuid
		 * @throws \RangeException if $newUuid is not a valid uuid v4
		 **/
		private static function validateUuid($newUuid): Uuid {
			// verify a string uuid
			if(gettype($newUuid) === "string") {
				// 16 characters is binary data from mySQL - convert to string and fall to next if block
				if(strlen($newUuid) === 16) {
					$newUuid = bin2hex($newUuid);
					$newUuid = substr($newUuid, 0, 8) . "-" . substr($newUuid, 8, 4) . "-" . substr($newUuid, 12, 4) . "-" . substr($newUuid, 16, 4) . "-" . substr($newUuid, 20, 12);
				}
				// 36 characters is a human readable uuid
				if(strlen($newUuid) === 36) {
					if(Uuid::isValid($newUuid) === false) {
						throw(new \InvalidArgumentException("invalid uuid"));
					}
					$uuid = Uuid::fromString($newUuid);
				} else {
					throw(new \InvalidArgumentException("invalid uuid"));
				}
			} else if(gettype($newUuid) === "object" && get_class($newUuid) === "Ramsey\\Uuid\\Uuid") {
				// if the misquote id is already a valid UUID, press on
				$uuid = $newUuid;
			} else {
				// throw out any other trash
				throw(new \InvalidArgumentException("invalid uuid"));
			}
			// verify the uuid is uuid v4
			if($uuid->getVersion() !== 4) {
				throw(new \RangeException("uuid is incorrect version"));
			}
			return ($uuid);
		}
	}

	/** PENS
	 *
	 * inserts new pen into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public function insert(\PDO $pdo): void {

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

	public function delete(\PDO $pdo): void {

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

	public function update(\PDO $pdo): void {

	// create query template
		$query = "UPDATE pen SET penName = :penName, penHtmlContent = :penHtmlContent, penCssContent = :penCssContent, penJsContent = :penJsContent WHERE penId = :penId";
		$statement = $pdo->prepare($query);

		$parameters = ["penId" => $this->penId->getBytes(), "penName" => $this->penName, "penHtmlContent" => $this->penHtmlContent, "penCssContent" => $this->penCssContent, "penJsContent" => $this->penJsContent];
		$statement->execute($parameters);

	}

}