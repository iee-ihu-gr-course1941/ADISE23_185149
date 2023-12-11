<?php
require_once('SECRETS.php');

$conn = new mysqli($servername, $username, $password, $username);

$sql = "

CREATE TRIGGER status_update_to_battle
	AFTER UPDATE ON player_ships FOR EACH ROW
	BEGIN $$
		IF (SELECT COUNT(*) FROM player_ships WHERE ship_status = 'Not Set') = 0 THEN
			UPDATE status SET gamestate = 'Battle' AND next_action = 'Player1';
		END IF;
	END$$;
";

if ($conn->multi_query($sql)) {
	echo "Worked\n";
}
$conn->close();
?>
