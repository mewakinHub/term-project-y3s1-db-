DELIMITER //

CREATE PROCEDURE AddFriend(IN from_user_id INT, IN to_user_id INT)
BEGIN
    -- Assuming there's no existing friend request or connection
    INSERT INTO friend (fromID, toID) VALUES (from_user_id, to_user_id);
END //

DELIMITER ;

-- Installed game
DELIMITER $$

CREATE PROCEDURE AddInstalledGame(IN user_id INT, IN game_id INT)
BEGIN
    -- Check if the game is already owned and installed by the user
    IF NOT EXISTS (SELECT 1 FROM `own` WHERE `userID` = user_id AND `gameID` = game_id) THEN
        -- Insert the new game as owned and installed
        INSERT INTO `own` (`userID`, `gameID`, `playtime`, `installed`)
        VALUES (user_id, game_id, 0, 1);
    ELSE
        -- If the game is already owned, just update the installed status
        UPDATE `own` SET `installed` = 1
        WHERE `userID` = user_id AND `gameID` = game_id;
    END IF;
END$$

DELIMITER ;

-- top-up balance

DELIMITER //
CREATE PROCEDURE TopUpBalance(IN user_id INT, IN top_up_amount FLOAT)
BEGIN
    UPDATE user SET balance = balance + top_up_amount WHERE userID = user_id;
END //
DELIMITER ;

