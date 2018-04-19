<?php

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
}

// CONSTRUCTOR

/**
 * accessor method for profileId
 *
 * @return Uuid value of profileId
 **/
public function getProfileId() : Uuid {
	return($this->profileId);
}

/**
 * mutator method for profile id
 *
 * @param Uuid|string $newProfileId new value of profile id
 * @throws \RangeException if $newProfileId is not positive
 * @throws \TypeError if $newProfileId is not a uuid or string
 **/
public function setProfileId($newProfileId) : void {
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
public function getProfileActivationToken() : string {
	return($this->profileActivationToken);
}

/**
 * mutator method for profileActivationToken
 *
 * @param string $newProfileActivationToken new value of profileActivationToken
 * @throws \TypeError if $newProfileActivationToken is not a string
 * @throws \RangeException if $newProfileActivationToken > 32chars OR empty string
 **/
public function setProfileActivationToken($newProfileActivationToken) : void {
	if(gettype($newProfileActivationToken) != string) {
		throw(new \TypeError("Input is not a string"));
	}

	if(0 > strlen($newProfileActivationToken) > 32 || empty($newProfileActivationToken) === true) {
		throw(new \RangeException("Activation token empty or too large"));
	}

}

/**
 * accessor method for profileAvatar
 *
 * @return string value of filepath to user's avatar
 **/
public function getProfileAvatar() : string {
	return($this->profileAvatar);
}

/**
 * mutator method for profileAvatar
 *
 * @param string $newProfileAvatar new value of profileAvatar
 * @throws \TypeError if input is not a string
 * @throws \RangeException if 0chars > $newProfileAvatar > 512chars
 **/
public function setProfileAvatar($newProfileAvatar) : void {
	if(gettype($newProfileAvatar) != string) {
		throw(new \TypeError("Input is not a string"));
	}

	if(0 > strlen($newProfileAvatar) > 512) {
		throw(new \RangeException("Avatar filepath input too large"));
	}

}

/**
 * accessor method for profileEmail
 *
 * @return string value of profileEmail
 **/
public function getProfileEmail() : string {
	return($this->profileEmail);
}

/**
 * mutator method for profileEmail
 *
 * @param string $newProfileEmail new val for profileEmail
 * @throws \InvalidArgumentException if input is insecure
 * @throws \TypeError if $newProfileEmail is not a string
 * @throws \RangeException if $newProfileEmail > 128chars
 **/
public function setProfileEmail($newProfileEmail) : void {
	// verify the token is secure
	$newProfileEmail = trim($newProfileEmail);
	$newProfileEmail = filter_var($newProfileEmail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	if(empty($newProfileEmail) === true) {
		throw(new \InvalidArgumentException("Email value is empty or insecure"));
	}

	if(gettype($newProfileEmail) != string) {
		throw(new \TypeError("Email input is not a string"));
	}

	if(strlen($newProfileEmail) > 128) {
		throw(new \RangeException("Email input too large"))
	}
}

/**
 * accessor method for profileIsPro
 *
 * @return bool value of profileIsPro
 **/
public function getProfileIsPro() : bool {
	return($this->profileIsPro);
}

/**
 * accessor method for profileName
 *
 * @return string value of profileName
 **/
public function getProfileName() : string {
	return($this->profileName);
}

/**
 * accessor method for profileUsername
 *
 * @return string value of profileUsername
 **/
public function getProfileUsername() : string {
	return($this->profileUsername);
}