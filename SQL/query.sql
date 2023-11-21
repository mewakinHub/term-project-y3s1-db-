SET GLOBAL net_buffer_length=1000000; 
SET GLOBAL max_allowed_packet=1000000000;

CREATE USER IF NOT EXISTS ggguser IDENTIFIED BY 'ggguser';

GRANT SELECT, EXECUTE ON ggg.* TO ggguser;
FLUSH PRIVILEGES;

USE ggg;

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

--trigger buy game 
DELIMITER $$

CREATE TRIGGER CheckEnoughBalance
BEFORE INSERT ON `own` FOR EACH ROW
BEGIN
    -- Variables to store game price and user balance.
    DECLARE gamePrice INT;
    DECLARE currentBalance FLOAT;

    -- Get the price of the game.
    SELECT `price` INTO gamePrice FROM `game` WHERE `gameID` = NEW.`gameID`;

    -- Get the user's current balance.
    SELECT `balance` INTO currentBalance FROM `user` WHERE `userID` = NEW.`userID`;

    -- Check if the user has enough balance.
    IF currentBalance < gamePrice THEN
        -- If not, prevent the insertion and show an error.
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Not enough balance to purchase the game';
    END IF;
END$$

DELIMITER ;


--buyy game 
DELIMITER $$

CREATE TRIGGER GamePurchase 
AFTER INSERT ON `own` FOR EACH ROW
BEGIN
    -- Variables to store game price and user balance.
    DECLARE gamePrice INT;
    DECLARE currentBalance FLOAT;

    -- Get the price of the game.
    SELECT `price` INTO gamePrice FROM `game` WHERE `gameID` = NEW.`gameID`;

    -- Get the user's current balance.
    SELECT `balance` INTO currentBalance FROM `user` WHERE `userID` = NEW.`userID`;

    -- Check if the user has enough balance.
    IF currentBalance >= gamePrice THEN
        -- Update the user's balance.
        UPDATE `user` SET `balance` = currentBalance - gamePrice
        WHERE `userID` = NEW.`userID`;
    ELSE
        -- If not enough balance, prevent the operation and show an error.
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Not enough balance to purchase the game';
    END IF;
END$$

DELIMITER ;

--update play time game
DELIMITER $$

CREATE PROCEDURE UpdatePlaytime(IN p_userID INT, IN p_gameID INT)
BEGIN
    UPDATE `own`
    SET `playtime` = `playtime` + 1,
        `latestPlay` = NOW()
    WHERE `userID` = p_userID AND `gameID` = p_gameID;
END$$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE AddBalance(IN user_id INT, IN top_up_amount FLOAT)
BEGIN
    UPDATE user SET balance = balance + top_up_amount WHERE userID = user_id;
END$$

DELIMITER ;
