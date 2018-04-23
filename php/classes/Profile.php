<?php

class Profile implements \JsonSerializable {
	use ValidateUuid;
	use Ramsey\Uuid\Uuid;

trait ValidateUuid {
	/**
	 * validates a uuid irrespective of format
	 *
	 * @param string|Uuid $newUuid uuid to validate
	 * @return Uuid object with validated uuid
	 * @throws \InvalidArgumentException if $newUuid is not a valid uuid
	 * @throws \RangeException if $newUuid is not a valid uuid v4
	 **/
	private static function validateUuid($newUuid) : Uuid {
		// verify a string uuid
		if(gettype($newUuid) === "string") {
			// 16 characters is binary data from mySQL - convert to string and fall to next if block
			if(strlen($newUuid) === 16) {
				$newUuid = bin2hex($newUuid);
				$newUuid = substr($newUuid, 0, 8) . "-" . substr($newUuid, 8, 4) . "-" . substr($newUuid,12, 4) . "-" . substr($newUuid, 16, 4) . "-" . substr($newUuid, 20, 12);
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
		return($uuid);
	}
}
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
 * @param string|Uuid $newProfileId id of this profile or null if a new Tweet
 * @param string $newProfileActivationToken
 * @param string $newProfileAvatar filepath to avatar
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
	}
		//determine what exception type was thrown
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
	 * mutator method for profile id
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
			throw(new \RangeException("Avatar filepath input too large OR empty string"));
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

		if(gettype($newProfileEmail) != string) {
			throw(new \TypeError("Email input must be a string"));
		}

		if(strlen($newProfileEmail) > 128) {
			throw(new \RangeException("Email input too large"))
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
	}
	/**
	 * accessor method for profileUsername
	 *
	 * @return string value of profileUsername
	 **/
	public function getProfileUsername(): string {
		return ($this->profileUsername);
	}
}