<?php
	include '../DB/db.php';
    session_start();

    $old_password = $_POST['old_password'];
    $new_password1 = $_POST['new_password1'];
    
    $user_sql = "SELECT * FROM users WHERE user_id ='".$_SESSION['user_id']."'";
    $result = mysqli_query($mysqli, $user_sql);
    $row = mysqli_fetch_array($result);

    $hashedPassword = $row['user_password'];
    $passwordResult = password_verify($old_password, $hashedPassword);
    if($passwordResult === true){
        //저장된 비밀번호와 같다
        
        $new_userpasswd1_hashed = password_hash($new_password1, PASSWORD_DEFAULT);
        $passwd_update_sql = "UPDATE users SET user_password = '".$new_userpasswd1_hashed."' WHERE user_id =".$_SESSION['user_id'].";";
        $passwd_update = mysqli_query($mysqli ,$passwd_update_sql);
        if($passwd_update === true){
        ?>
            <script>
                alert("비밀번호 변경에 성공하였습니다.")
                history.back();
            </script>
        <?php
        } else{
            ?>
                <script>
                    alert("비밀번호 변경에 실패하였습니다.")
                    history.back();
                </script>
            <?php
        }
        ?>
        <script>
            alert("비밀번호 변경에 성공하였습니다.")
            history.back();
        </script>
    <?php
    } else {
        ?>
        <script>
            alert("비밀번호 변경에 실패하였습니다. - 기존 비밀번호 틀림!")
            history.back();
        </script>
    <?php
    }
?>