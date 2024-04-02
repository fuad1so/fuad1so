<?php
require_once('db_connection.php');
   

    // $stmt = $pdo->prepare("SELECT user_id, username,email, password,profile_image, date_registered FROM user WHERE email = ?");
    // $stmt->execute([$email]);
    // $user = $stmt->fetch();

    if(isset($_SESSION['user'])){
        $user_id = $_SESSION['user']['user_id'];
    }

   
    
// Check if the file is uploaded successfully
if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['file'];
    $file_name = $file['name'];


        $targetPath = 'images/profile_image/' . basename($file['name']);

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            // Insert file details into the database (You may modify this part based on your database structure)
            // $sql = "INSERT INTO user (profile_image,) VALUES ('" . $file['name'] . "', '" . $targetPath . "')";
           
            $stmt = $pdo->prepare("UPDATE user SET profile_image = ? WHERE user_id =? ");
            $stmt->execute([$file_name, $user_id]);
            if ($stmt->rowCount() > 0) {
                $_SESSION['user']['profile_image'] = $file_name;
                $response = array('message' => 'File uploaded successfully.');
                echo json_encode($file_name);
           
                } else {
                // $response = array('message' => 'Error uploading file. Database error.');
                echo json_encode('Error uploading file. Database error.');
                // echo json_encode($response);
            }
        } else {
            // $response = array('message' => 'Error uploading file.');
            echo json_encode('Error uploading file.');
            echo json_encode($response);
        }

}

// header('Content-Type: application/json');
// echo json_encode($response);
?>
