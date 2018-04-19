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
	 * id of the Profile that sent this Tweet
	 * @var Uuid $profileActivationToken
	 **/
	private $profileActivationToken;
	/**
	 * actual textual content of this Tweet
	 * @var string $profileAvatar
	 **/
	private $profileAvatar;
	/**
	 * date and time this Tweet was sent, in a PHP DateTime object
	 * @var \DateTime profileEmail
	 **/
	private profileEmail;
	/**
	 * date and time this Tweet was sent, in a PHP DateTime object
	 * @var \DateTime profileIsPro
	 **/
	private profileIsPro;
	/**
	 * date and time this Tweet was sent, in a PHP DateTime object
	 * @var \DateTime profileName
	 **/
	private profileName;
	/**
	 * date and time this Tweet was sent, in a PHP DateTime object
	 * @var \DateTime profileUsername
	 **/
	private profileUsername;
