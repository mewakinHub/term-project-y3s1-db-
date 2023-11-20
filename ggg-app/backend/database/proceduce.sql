DELIMITER //

CREATE PROCEDURE AddFriend(IN from_user_id INT, IN to_user_id INT)
BEGIN
    -- Assuming there's no existing friend request or connection
    INSERT INTO friend (fromID, toID) VALUES (from_user_id, to_user_id);
END //

DELIMITER ;
