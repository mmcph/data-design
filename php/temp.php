<?php

/** PROFILE
 *
 * inserts new profile into mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
**/

public function insert(\PDO $pdo) : void {

// create query template
$query = "INSERT INTO profile(profileId, profileActivationToken, profileAvatar, profileEmail, profileIsPro, profileName, profileUsername) VALUES(:profileId, :profileActivationToken, :profileAvatar, :profileEmail, :profileIsPro, :profileName, :profileUsername)";
$statement = $pdo->prepare($query);

// bind the member variables to the placeholders in the template
$parameters = ["profileId" => $this->profileID->getBytes(), "profileActivationToken" => $this->profileActivationToken, "profileAvatar" => $this->profileAvatar, "profileEmail" => $this->profileEmail, "profileIsPro" => $this->profileIsPro, "profileName" => $this->profileName, "profileUsername" => $this->profileUsername];
$statement->execute($parameters);
}

/** deletes this profile from mysql
 *
 * @param \PDO $pdo PDO connection object
 *  @throws \PDOException when mySQL related errors occur
 *  @throws \TypeError if $pdo is not a PDO connection object
**/

public function delete(\PDO $pdo) : void {

// create query template
$query = "DELETE FROM profile WHERE profileId = :profileId";
$statement = $pdo->prepare($query);

// bind member vars to placeholder in template
$parameters = ["profileId" => $this->profileId->getBytes()];
$statement->execute($parameters);
}

/** updates this profile in mysql
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
**/

public function update(\PDO $pdo) : void {

// create query template
$query = "UPDATE profile SET profileActivationToken = :profileActivationToken, profileAvatar = :profileAvatar, profileEmail = :profileEmail, profileIsPro = :profileIsPro, profileName = :profileName, profileUsername = :profileUsername WHERE profileId = :profileId";
$statement = $pdo->prepare($query);

$parameters = ["profileId" => $this->profileId->getBytes(), "profileActivationToken" => $this->profileActivationToken, "profileAvatar" => $this->profileAvatar, "profileEmail" => $this->profileEmail, "profileIsPro" => $this->profileIsPro, "profileName" => $this->profileName, "profileUsername" => $this->profileUsername];
$statement->execute($parameters);
}

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
$query = "INSERT INTO pen(penId, penProfileId, penName, penHtmlContent, penCssContent, penJsContent) VALUES(:penId, :penProfileId, :penName, :penHtmlContent, :penCssContent, :penJsContent)";
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