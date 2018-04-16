ALTER DATABASE data-design CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS comment;
DROP TABLE IF EXISTS pen;
DROP TABLE IF EXISTS profile;

CREATE TABLE profile (
	profileId BINARY(16) NOT NULL,
	profileActivationToken CHAR(32),
	profileName VARCHAR(32) NOT NULL,
	profileUsername VARCHAR(32) NOT NULL,
	profileEmail VARCHAR(128) NOT NULL,
	-- Avatars stored in file system, DB stores the FILEPATH
	-- VARCHAR VALUE ???
	profileAvatar VARCHAR(MAX),
	-- profileIsPro acts as a bool to check Pro account status
	profileIsPro TINYINT NOT NULL,
	UNIQUE(profileId),
	UNIQUE(profileEmail),
	PRIMARY KEY(profileId)
);

CREATE TABLE pen (
	penId BINARY(16) NOT NULL,
	penProfileId BINARY(16) NOT NULL,
	penName VARCHAR(64),
	-- pen code content attrs work like profileAvatar
	penHtmlContent VARCHAR(MAX),
	penCssContent VARCHAR(MAX),
	penJsContent VARCHAR(MAX),
	UNIQUE(penId),
	INDEX(penProfileId),
	FOREIGN KEY(penProfileId) REFERENCES profile(profileId),
	PRIMARY KEY(penId)
);

CREATE TABLE comment (
	commentProfileId BINARY(16) NOT NULL,
	commentPenId BINARY(16) NOT NULL,
-- 	commentId BINARY(16) NOT NULL, <-not needed ???
	commentDateTime DATETIME(6),
	-- commentContent also stores filepath
	commentContent VARCHAR(MAX),
	INDEX(commentProfileId),
	INDEX(commentPenId),
	FOREIGN KEY(commentProfileId) REFERENCES profile(profileId),
	FOREIGN KEY(commentPenId) REFERENCES pen(penId),
	PRIMARY KEY(commentProfileId, commentPenId)
);