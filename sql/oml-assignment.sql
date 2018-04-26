-- ins/del/update for Profile
INSERT INTO profile(profileId, profileActivationToken, profileAvatar, profileEmail, profileIsPro, profileName, profileUsername)
VALUES (UNHEX(REPLACE("01ceecf9-d01b-4af2-b5dcf1235891044f", "-", "")), "whatever an activation token looks like (VARCHAR(255))", "hypothetical/filepath/to/avatar.jpg", "mcpherspam@gmail.com", "1", "Marlon McPherson", "mmcph");

DELETE FROM profile WHERE profileId = UNHEX(REPLACE("01ceecf9-d01b-4af2-b5dcf1235891044f", "-", ""));

UPDATE profile SET profileActivationToken = "whatever an activation token looks like (VARCHAR(255))", profileAvatar = "hypothetical/filepath/to/avatar.jpg", profileEmail = "mcpherspam@gmail.com", profileIsPro = "1", profileName = "Marlon McPherson", profileUsername = "mmcph" WHERE profileId = UNHEX(REPLACE("01ceecf9-d01b-4af2-b5dcf1235891044f", "-", ""));

-- ins/del/update for Pen
INSERT INTO pen(penId, penProfileId, penCssContent, penHtmlContent, penJsContent, penName)
VALUES (UNHEX(REPLACE("1772c05b-dc60-4d18-a4b3-93f00d7f48df", "-", "")), UNHEX(REPLACE("01ceecf9-d01b-4af2-b5dcf1235891044f", "-", "")), "hypothetical/filepath/to/penCssContent", "hypothetical/filepath/to/penHtmlContent", "hypothetical/filepath/to/penJsContent", "My Pen");

DELETE FROM pen WHERE penId = UNHEX(REPLACE("1772c05b-dc60-4d18-a4b3-93f00d7f48df", "-", ""));

UPDATE pen SET penName = "My Pen", penCssContent = "hypothetical/filepath/to/penCssContent", penHtmlContent = "hypothetical/filepath/to/penHtmlContent", penJsContent = "hypothetical/filepath/to/penJsContent" WHERE penId = UNHEX(REPLACE("1772c05b-dc60-4d18-a4b3-93f00d7f48df", "-", ""));