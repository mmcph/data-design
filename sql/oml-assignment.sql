-- PROFILE

-- inserts new profile into mySQL
--
-- @param \PDO $pdo PDO connection object
-- @throws \PDOException when mySQL related errors occur
-- @throws \TypeError if $pdo is not a PDO connection object

	public function insert(\PDO $pdo) : void {

		-- create query template
		$query = "INSERT INTO profile(profileId, profileActivationToken, profileAvatar, profileEmail, profileIsPro, profileName, profileUsername) VALUES(:profileId, :profileActivationToken, :profileAvatar, :profileEmail, :profileIsPro, :profileName, :profileUsername)";
		$statement = $pdo->prepare($query);

		-- bind the member variables to the placeholders in the template
		$parameters = ["profileId" => $this->profileID->getBytes(), "profileActivationToken" => $this->profileActivationToken, "profileAvatar" => $this->profileAvatar, "profileEmail" => $this->profileEmail, "profileIsPro" => $this->profileIsPro, "profileName" => $this->profileName, "profileUsername" => $this->profileUsername];
		$statement->execute($parameters);
	}

-- deletes this profile from mysql
--
-- @param \PDO $pdo PDO connection object
-- @throws \PDOException when mySQL related errors occur
-- @throws \TypeError if $pdo is not a PDO connection object

	public function delete(\PDO $pdo) : void {

		-- create query template
		$query = "DELETE FROM profile WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);

		-- bind member vars to placeholder in template
		$parameters = ["profileId" => $this->profileId->getBytes()];
		$statement->execute($parameters);
	}

-- updates this profile in mysql
--
-- @param \PDO $pdo PDO connection object
-- @throws \PDOException when mySQL related errors occur
-- @throws \TypeError if $pdo is not a PDO connection object

	public function update(\PDO $pdo) : void {

		-- create query template
		$query = "UPDATE profile SET profileActivationToken = :profileActivationToken, profileAvatar = :profileAvatar, profileEmail = :profileEmail, profileIsPro = :profileIsPro, profileName = :profileName, profileUsername = :profileUsername WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);

		$parameters = ["profileId" => $this->profileId->getBytes(), "profileActivationToken" => $this->profileActivationToken, "profileAvatar" => $this->profileAvatar, "profileEmail" => $this->profileEmail, "profileIsPro" => $this->profileIsPro, "profileName" => $this->profileName, "profileUsername" => $this->profileUsername];
		$statement->execute($parameters);
	}

-- PENS

-- inserts new pen into mySQL
--
-- @param \PDO $pdo PDO connection object
-- @throws \PDOException when mySQL related errors occur
-- @throws \TypeError if $pdo is not a PDO connection object

	public function insert(\PDO $pdo) : void {

		-- create query template
		$query = "INSERT INTO pen(profileId, profileActivationToken, profileAvatar, profileEmail, profileIsPro, profileName, profileUsername) VALUES(:profileId, :profileActivationToken, :profileAvatar, :profileEmail, :profileIsPro, :profileName, :profileUsername)";
		$statement = $pdo->prepare($query);

		-- bind the member variables to the placeholders in the template
		$parameters = ["profileId" => $this->profileID->getBytes(), "profileActivationToken" => $this->profileActivationToken, "profileAvatar" => $this->profileAvatar, "profileEmail" => $this->profileEmail, "profileIsPro" => $this->profileIsPro, "profileName" => $this->profileName, "profileUsername" => $this->profileUsername];
		$statement->execute($parameters);
	}

-- deletes this profile from mysql
--
-- @param \PDO $pdo PDO connection object
-- @throws \PDOException when mySQL related errors occur
-- @throws \TypeError if $pdo is not a PDO connection object

	public function delete(\PDO $pdo) : void {

		-- create query template
		$query = "DELETE FROM profile WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);

		-- bind member vars to placeholder in template
		$parameters = ["profileId" => $this->profileId->getBytes()];
		$statement->execute($parameters);
	}

-- updates this profile in mysql
--
-- @param \PDO $pdo PDO connection object
-- @throws \PDOException when mySQL related errors occur
-- @throws \TypeError if $pdo is not a PDO connection object

	public function update(\PDO $pdo) : void {

		-- create query template
		$query = "UPDATE profile SET profileActivationToken = :profileActivationToken, profileAvatar = :profileAvatar, profileEmail = :profileEmail, profileIsPro = :profileIsPro, profileName = :profileName, profileUsername = :profileUsername WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);

		$parameters = ["profileId" => $this->profileId->getBytes(), "profileActivationToken" => $this->profileActivationToken, "profileAvatar" => $this->profileAvatar, "profileEmail" => $this->profileEmail, "profileIsPro" => $this->profileIsPro, "profileName" => $this->profileName, "profileUsername" => $this->profileUsername];
		$statement->execute($parameters);
	}