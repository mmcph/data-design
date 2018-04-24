-- ins/del/update for Profile
INSERT INTO profile(profileId, profileActivationToken, profileAvatar, profileEmail, profileIsPro, profileName, profileUsername) VALUES(:profileId, :profileActivationToken, :profileAvatar, :profileEmail, :profileIsPro, :profileName, :profileUsername);

DELETE FROM profile WHERE profileId = :profileId;

UPDATE profile SET profileActivationToken = :profileActivationToken, profileAvatar = :profileAvatar, profileEmail = :profileEmail, profileIsPro = :profileIsPro, profileName = :profileName, profileUsername = :profileUsername WHERE profileId = :profileId;

-- ins/del/update for Pen
INSERT INTO pen(penId, penProfileId, penName, penHtmlContent, penCssContent, penJsContent) VALUES(:penId, :penProfileId, :penName, :penHtmlContent, :penCssContent, :penJsContent);

DELETE FROM pen WHERE penId = :penId;

UPDATE pen SET penName = :penName, penHtmlContent = :penHtmlContent, penCssContent = :penCssContent, penJsContent = :penJsContent WHERE penId = :penId;