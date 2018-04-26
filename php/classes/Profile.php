<?php

namespace Edu\Cnm\DataDesign;

require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

class Profile implements \JsonSerializable {
	use ValidateUuid;

	/**
	 * id for this Profile; this is the primary key
	 * @var Uuid $profileId
	 **/
	private $profileId;
	/**
	 * token that verifies user account activation
	 * @var string $profileActivationToken
	 **/
	private $profileActivationToken;
	/**
	 * stores the filepath to the user's avatar image in the file system
	 * @var string $profileAvatar
	 **/
	private $profileAvatar;
	/**
	 * user's email address
	 * @var string $profileEmail
	 **/
	private $profileEmail;
	/**
	 * bool to check for Pro status on account
	 * @var int profileIsPro
	 **/
	private $profileIsPro;
	/**
	 * the user's name
	 * @var string profileName
	 **/
	private $profileName;
	/**
	 * the user's profile name
	 * @var string profileUsername
	 **/
	private $profileUsername;


// Constructor

	/**
	 * constructor for Profile
	 *
	 * @param string|Uuid $newProfileId id of this profile or null if a new profile
	 * @param string $newProfileActivationToken
	 * @param string $newProfileAvatar file path to avatar
	 * @param string $newProfileEmail user's email
	 * @param bool $newProfileIsPro checks pro status on account
	 * @param string $newProfileName user's name
	 * @param string $newProfileUsername user's displayed username
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newProfileId, string $newProfileActivationToken, string $newProfileAvatar, string $newProfileEmail, bool $newProfileIsPro, string $newProfileName, string $newProfileUsername) {
		try {
			$this->setProfileId($newProfileId);
			$this->setProfileActivationToken($newProfileActivationToken);
			$this->setProfileAvatar($newProfileAvatar);
			$this->setProfileEmail($newProfileEmail);
			$this->setProfileIsPro($newProfileIsPro);
			$this->setProfileName($newProfileName);
			$this->setProfileUsername($newProfileUsername);
		} //determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for profileId
	 *
	 * @return Uuid value of profileId
	 **/
	public function getProfileId(): Uuid {
		return ($this->profileId);
	}

	/**
	 * mutator method for profileId
	 *
	 * @param Uuid|string $newProfileId new value of profile id
	 * @throws \RangeException if $newProfileId is not positive
	 * @throws \TypeError if $newProfileId is not a uuid or string
	 **/
	public function setProfileId($newProfileId): void {
		try {
			$uuid = self::validateUuid($newProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the profile id
		$this->profileId = $uuid;
	}

	/**
	 * accessor method for profileActivationToken
	 *
	 * @return string value of profileActivationToken
	 **/
	public function getProfileActivationToken(): string {
		return ($this->profileActivationToken);
	}

	/**
	 * mutator method for profileActivationToken
	 *
	 * @param string $newProfileActivationToken new value of profileActivationToken
	 * @throws \TypeError if $newProfileActivationToken is not a string
	 * @throws \RangeException if $newProfileActivationToken > 32chars OR empty string
	 **/
	public function setProfileActivationToken($newProfileActivationToken): void {
		if(is_string($newProfileActivationToken) === false) {
			throw(new \TypeError("Input is not a string"));
		}

		if(strlen($newProfileActivationToken) > 32 || empty($newProfileActivationToken) === true) {
			throw(new \RangeException("Activation token empty or too large"));
		}
		// store new profileActivationToken
		$this->profileActivationToken = $newProfileActivationToken;

	}

	/**
	 * accessor method for profileAvatar
	 *
	 * @return string value of filepath to user's avatar
	 **/
	public function getProfileAvatar(): string {
		return ($this->profileAvatar);
	}

	/**
	 * mutator method for profileAvatar
	 *
	 * @param string $newProfileAvatar new value of profileAvatar
	 * @throws \TypeError if input is not a string
	 * @throws \RangeException if $newProfileAvatar > 512chars OR is empty string
	 **/
	public function setProfileAvatar($newProfileAvatar): void {
		if(is_string($newProfileAvatar) === false) {
			throw(new \TypeError("Input must be a string"));
		}

		if(strlen($newProfileAvatar) > 512 || empty($newProfileAvatar) === true) {
			throw(new \RangeException("Avatar file path input too large OR empty string"));
		}
		// store new profileAvatar filepath
		$this->profileAvatar = $newProfileAvatar;

	}

	/**
	 * accessor method for profileEmail
	 *
	 * @return string value of profileEmail
	 **/
	public function getProfileEmail(): string {
		return ($this->profileEmail);
	}

	/**
	 * mutator method for profileEmail
	 *
	 * @param string $newProfileEmail new val for profileEmail
	 * @throws \InvalidArgumentException if input is insecure
	 * @throws \TypeError if $newProfileEmail is not a string
	 * @throws \RangeException if $newProfileEmail > 128chars
	 **/
	public function setProfileEmail($newProfileEmail): void {
		// verify the token is secure
		$newProfileEmail = trim($newProfileEmail);
		$newProfileEmail = filter_var($newProfileEmail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileEmail) === true) {
			throw(new \InvalidArgumentException("Email value is empty or insecure"));
		}

		if(is_string($newProfileEmail) === false) {
			throw(new \TypeError("Email input must be a string"));
		}

		if(strlen($newProfileEmail) > 128) {
			throw(new \RangeException("Email input too large"));
		}
		// store new profileEmail
		$this->profileEmail = $newProfileEmail;
	}

	/**
	 * accessor method for profileIsPro
	 *
	 * @return bool value of profileIsPro
	 **/
	public function getProfileIsPro(): bool {
		return ($this->profileIsPro);
	}

	/**
	 * mutator method for profileIsPro
	 *
	 * @param bool $newProfileIsPro new val for profileIsPro
	 * @throws \TypeError if $newProfileIsPro !=== bool
	 **/
	public function setProfileIsPro($newProfileIsPro): void {
		if(is_bool($newProfileIsPro) === false) {
			throw(new \TypeError("profileIsPro must be a boolean"));
		}
		// store new profileIsPro
		$this->profileIsPro = $newProfileIsPro;
	}

	/**
	 * accessor method for profileName
	 *
	 * @return string value of profileName
	 **/
	public function getProfileName(): string {
		return ($this->profileName);
	}

	/**
	 * mutator method for profileName
	 *
	 * @param string $newProfileName new val for profileName
	 * @throws \InvalidArgumentException if $newProfileName is insecure or empty
	 * @throws \TypeError if $newProfileName !=== string
	 * @throws \RangeException if $newProfileName > 32chars
	 **/
	public function setProfileName($newProfileName): void {
		// verify the token is secure
		$newProfileName = trim($newProfileName);
		$newProfileName = filter_var($newProfileName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileName) === true) {
			throw(new \InvalidArgumentException("profileName value is empty or insecure"));
		}

		if(is_string($newProfileName) === false) {
			throw(new \TypeError("profileName must be a string"));
		}

		if(strlen($newProfileName) > 32) {
			throw(new \RangeException("profileName input too large"));
		}

		$this->profileName = $newProfileName;
	}

	/**
	 * accessor method for profileUsername
	 *
	 * @return string value of profileUsername
	 **/
	public function getProfileUsername(): string {
		return ($this->profileUsername);
	}

	/**
	 * mutator method for profileUsername
	 *
	 * @param string $newProfileUsername new val for profile username
	 * @throws \InvalidArgumentException if $newProfileUsername is insecure or empty
	 * @throws \TypeError if $newProfileUsername !=== string
	 * @throws \RangeException if $newProfileUsername > 32chars
	 **/
	public function setProfileUsername($newProfileUsername): void {
		// verify the token is secure
		$newProfileUsername = trim($newProfileUsername);
		$newProfileUsername = filter_var($newProfileUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileUsername) === true) {
			throw(new \InvalidArgumentException("profileUsername value is empty or insecure"));
		}

		if(gettype($newProfileUsername) != string) {
			throw(new \TypeError("ProfileUsername must be a string"));
		}

		if(strlen($newProfileUsername) > 32) {
			throw(new \RangeException("profileUsername input too large"));
		}

		$this->profileUsername = $newProfileUsername;
	}

	/** inserts new profile into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public function insert(\PDO $pdo): void {

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
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public function delete(\PDO $pdo): void {

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

	public function update(\PDO $pdo): void {

		// create query template
		$query = "UPDATE profile SET profileActivationToken = :profileActivationToken, profileAvatar = :profileAvatar, profileEmail = :profileEmail, profileIsPro = :profileIsPro, profileName = :profileName, profileUsername = :profileUsername WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);

		$parameters = ["profileId" => $this->profileId->getBytes(), "profileActivationToken" => $this->profileActivationToken, "profileAvatar" => $this->profileAvatar, "profileEmail" => $this->profileEmail, "profileIsPro" => $this->profileIsPro, "profileName" => $this->profileName, "profileUsername" => $this->profileUsername];
		$statement->execute($parameters);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize(): array {
		$fields = get_object_vars($this);

		$fields["profileId"] = $this->profileId->toString();
		return ($fields);
	}

}