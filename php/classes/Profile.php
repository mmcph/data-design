<?php

class Profile implements \JsonSerializable {
	use ValidateDate;
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

/**
 * accessor method for profile id
 *
 * @return Uuid value of profile id
 **/
public function getProfileId() : Uuid {
	return($this->profileId);
}

/**
 * mutator method for profile id
 *
 * @param Uuid|string $newTweetId new value of tweet id
 * @throws \RangeException if $newProfileId is not positive
 * @throws \TypeError if $newProfileId is not a uuid or string
 **/
public function setProfileId( $newProfileId) : void {
	try {
		$uuid = self::validateUuid($newProfileId);
	} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}

	// convert and store the tweet id
	$this->profileId = $uuid;
}
