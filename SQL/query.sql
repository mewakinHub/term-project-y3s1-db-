SET GLOBAL net_buffer_length=1000000; 
SET GLOBAL max_allowed_packet=1000000000;

CREATE USER IF NOT EXISTS ggguser IDENTIFIED BY 'ggguser';

GRANT SELECT ON ggg.* TO ggguser;
FLUSH PRIVILEGES;

GRANT INSERT, DELETE ON ggg.friend TO ggguser;
FLUSH PRIVILEGES;

GRANT EXECUTE ON PROCEDURE ggg.AddFriend TO ggguser;
FLUSH PRIVILEGES;

GRANT EXECUTE ON PROCEDURE ggg.own TO ggguser;
FLUSH PRIVILEGES;

GRANT EXECUTE ON PROCEDURE ggg.Buygame TO ggguser;
FLUSH PRIVILEGES;

GRANT EXECUTE ON PROCEDURE ggg.AddInstalledGame TO ggguser;
FLUSH PRIVILEGES;


GRANT INSERT, DELETE,UPDATE ON ggg.own TO ggguser;
FLUSH PRIVILEGES;

GRANT INSERT, DELETE ON ggg.rate TO ggguser;
FLUSH PRIVILEGES;

GRANT INSERT, UPDATE ON ggg.user TO ggguser;
FLUSH PRIVILEGES;

GRANT EXECUTE ON PROCEDURE ggg.TopUpBalance TO ggguser;
FLUSH PRIVILEGES;