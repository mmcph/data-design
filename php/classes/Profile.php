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
	 * id of the Profile that sent this Tweet; this is a foreign key
	 * @var Uuid $tweetProfileId
	 **/
	private $tweetProfileId;
	/**
	 * actual textual content of this Tweet
	 * @var string $tweetContent
	 **/
	private $tweetContent;
	/**
	 * date and time this Tweet was sent, in a PHP DateTime object
	 * @var \DateTime $tweetDate
	 **/
	private $tweetDate;