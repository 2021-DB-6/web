<?php
	if($row['room_type'] == 'resort'){echo "리조트";}elseif($row['room_type'] == 'pension'){echo "펜션";}elseif($row['room_type'] == 'hotel'){echo "호텔";}elseif($row['room_type'] == 'motel'){echo "모텔";}elseif($row['room_type'] == 'poolvilla'){echo "풀빌라";}elseif($row['room_type'] == 'pension'){echo "펜션";} else{echo "기타";}
?>