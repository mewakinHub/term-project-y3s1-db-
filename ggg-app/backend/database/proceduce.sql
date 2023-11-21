DELIMITER //

CREATE PROCEDURE AddFriend(IN from_user_id INT, IN to_user_id INT)
BEGIN
    -- Assuming there's no existing friend request or connection
    INSERT INTO friend (fromID, toID) VALUES (from_user_id, to_user_id);
END //

DELIMITER ;

-- Installed game
DELIMITER $$

-- Installed Game
CREATE PROCEDURE AddInstalledGame(IN user_id INT, IN game_id INT)
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

--Buy Game 
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


--gmaepurchase
BEGIN
    -- Declare a variable to store the price of the game
    DECLARE gamePrice INT;

    -- Select the price of the game into the variable based on the inserted gameID
    SELECT `price` INTO gamePrice FROM `game` WHERE `gameID` = NEW.`gameID`;

    -- Update the user's balance, decrease it by the game price
    UPDATE `users`
    SET `balance` = `balance` - gamePrice
    WHERE `userID` = NEW.`userID`;
END$$

DELIMITER ;



DELIMITER ;

-- top-up balance

DELIMITER //
CREATE PROCEDURE TopUpBalance(IN user_id INT, IN top_up_amount FLOAT)
BEGIN
    UPDATE user SET balance = balance + top_up_amount WHERE userID = user_id;
END //
DELIMITER ;




--trigger buy game 
DELIMITER $$
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
 DELIMITER //

CREATE PROCEDURE UpdatePlaytime(IN p_userID INT, IN p_gameID INT)
BEGIN
    UPDATE `own`
    SET `playtime` = `playtime` + 1,
        `latestPlay` = NOW()
    WHERE `userID` = p_userID AND `gameID` = p_gameID;
END;

//

DELIMITER ;


DELIMITER //

CREATE PROCEDURE UpdateUser(
    IN p_userID INT,
    IN p_email VARCHAR(64),
    IN p_password VARCHAR(64),
    IN p_username VARCHAR(32),
    IN p_bio VARCHAR(256),
    IN p_profilePicFile LONGBLOB
)
BEGIN
    UPDATE `user`
    SET
        `email` = p_email,
        `password` = p_password,
        `username` = p_username,
        `bio` = p_bio,
        `profilePicFile` = p_profilePicFile
    WHERE
        `userID` = p_userID;
END //

DELIMITER ;