SET GLOBAL net_buffer_length=1000000; 
SET GLOBAL max_allowed_packet=1000000000;

CREATE USER IF NOT EXISTS ggguser IDENTIFIED BY 'ggguser';

GRANT SELECT, EXECUTE ON ggg.* TO ggguser;
FLUSH PRIVILEGES;

DELIMITER $$

CREATE PROCEDURE BuyGame(IN user_id INT, IN game_id INT)
BEGIN
    -- Check if the game is not already owned by the user
    IF NOT EXISTS (SELECT 1 FROM `own` WHERE `userID` = user_id AND `gameID` = game_id) THEN
        -- Insert the new game as owned with default values
        INSERT INTO `own` (`userID`, `gameID`)
        VALUES (user_id, game_id);
    END IF;
END$$

DELIMITER ;

DELIMITER $$

-- Install Game
CREATE PROCEDURE InstallGame(IN user_id INT, IN game_id INT)
BEGIN
    -- Check if the game is already owned by the user
    IF EXISTS (SELECT 1 FROM `own` WHERE `userID` = user_id AND `gameID` = game_id) THEN
    -- Update the installed status only if it is currently 0
        UPDATE `own`
        SET `installed` = 1
        WHERE `userID` = user_id AND `gameID` = game_id AND `installed` = 0;
    END IF;
END$$

DELIMITER ;

DELIMITER $$

-- Uninstall Game
CREATE PROCEDURE UninstallGame(IN user_id INT, IN game_id INT)
BEGIN
    -- Check if the game is already owned by the user
    IF EXISTS (SELECT 1 FROM `own` WHERE `userID` = user_id AND `gameID` = game_id) THEN
    -- Update the installed status only if it is currently 1
        UPDATE `own`
        SET `installed` = 0
        WHERE `userID` = user_id AND `gameID` = game_id AND `installed` = 1;
    END IF;
END$$

DELIMITER ;