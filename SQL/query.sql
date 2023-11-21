SET GLOBAL net_buffer_length=1000000; 
SET GLOBAL max_allowed_packet=1000000000;

CREATE USER IF NOT EXISTS ggguser IDENTIFIED BY 'ggguser';

GRANT SELECT ON ggg.* TO ggguser;
FLUSH PRIVILEGES;

GRANT INSERT, DELETE ON ggg.friend TO ggguser;
FLUSH PRIVILEGES;

GRANT INSERT, DELETE ON ggg.own TO ggguser;
FLUSH PRIVILEGES;

GRANT INSERT, DELETE ON ggg.rate TO ggguser;
FLUSH PRIVILEGES;

GRANT INSERT, UPDATE ON ggg.user TO ggguser;
FLUSH PRIVILEGES;

DELIMITER $$

CREATE PROCEDURE BuyGame(IN user_id INT, IN game_id INT)
BEGIN
    -- Check if the game is not already owned by the user
    IF NOT EXISTS (SELECT 1 FROM `own` WHERE `userID` = user_id AND `gameID` = game_id) THEN
        -- Insert the new game as owned with default values
        INSERT INTO `own` (`userID`, `gameID`, `playtime`, `latestPlay`, `installed`)
        VALUES (user_id, game_id, 0, current_time, 0);
    END IF;
END$$

DELIMITER ;