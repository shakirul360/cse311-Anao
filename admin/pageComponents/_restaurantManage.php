<?php
include 'connectdb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['addRestaurant'])) {
        $name = $_POST["name"];
        $location = $_POST["address"];
        $type = $_POST["rest_type"];
        $email = $_POST["email"];
        $contact = $_POST["phone"];
        $desc = $_POST["description"];
        $pass = $_POST["password"];
        $cpass = $_POST["cpassword"];

        if ($pass == $cpass) {
            $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
        }else {
            echo "<script>alert('Password and Confirm Password do not match.');
                window.location=document.referrer;
                </script>";
            exit;
        }

        $sql = "INSERT INTO `rest_reg` (`restaurant_name`, `type` , `location`, `email`, `contact_no`, `description`, `password`) VALUES ('$name', '$type', '$location', '$email', '$contact ', '$desc', '$hashed_pass')";   
        $result = mysqli_query($conn, $sql);
        $restId = mysqli_insert_id($conn);

        if ($result) {
            if (isset($_FILES["image"])) {
                $check = getimagesize($_FILES["image"]["tmp_name"]);

                if ($check !== false) {
                    $newfilename = "card-" . $restId . ".jpg";
                    $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/anao_main/images/';
                    $uploadfile = $uploaddir . $newfilename;

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                        echo "<script>alert('Success!');
                            window.location=document.referrer;
                            </script>";
                    } else {
                        echo "<script>alert('Failed to upload image.');
                            window.location=document.referrer;
                            </script>";
                    }
                } else {
                    echo "<script>alert('Please select an image file to upload.');
                        window.location=document.referrer;
                        </script>";
                }
            } else {
                echo "<script>alert('Image not found.');
                    window.location=document.referrer;
                    </script>";
            }
        } else {
            echo "<script>alert('Failed to add restaurant.');
                window.location=document.referrer;
                </script>";
        }
    }

    if (isset($_POST['removeRestaurant'])) {
        $restId = $_POST["restId"];
        $filename = $_SERVER['DOCUMENT_ROOT'] . "/anao_main/images/card-" . $restId . ".jpg";

        // Step 1: Get the maximum id from the table
        $sqlMaxId = "SELECT MAX(id) AS maxId FROM rest_reg";
        $resultMaxId = $conn->query($sqlMaxId);

        if ($resultMaxId && $resultMaxId->num_rows > 0) {
            $rowMaxId = $resultMaxId->fetch_assoc();
            $maxId = $rowMaxId['maxId'];

            // Step 2: Delete the row
            $sqlDelete = "DELETE FROM rest_reg WHERE id = '$restId'";
            $resultDelete = $conn->query($sqlDelete);

            if ($resultDelete) {
                if (file_exists($filename)) {
                    unlink($filename);
                }

                // Step 3: Update the id of subsequent records
                if ($maxId > 1) {
                    for ($i = $restId + 1; $i <= $maxId; $i++) {
                        $newId = $i - 1;
                        $sqlUpdate = "UPDATE rest_reg SET id = '$newId' WHERE id = '$i'";
                        $conn->query($sqlUpdate);

                        // Update the image filename
                        $oldFilename = $_SERVER['DOCUMENT_ROOT'] . "/anao_main/images/card-" . $i . ".jpg";
                        $newFilename = $_SERVER['DOCUMENT_ROOT'] . "/anao_main/images/card-" . $newId . ".jpg";
                        if (file_exists($oldFilename)) {
                            rename($oldFilename, $newFilename);
                        }
                    }
                }

                // Step 4: Reset id sequence if all items are removed
                $sqlResetId = "ALTER TABLE rest_reg AUTO_INCREMENT = 1";
                $conn->query($sqlResetId);

                echo "<script>alert('Removed!');
                    window.location=document.referrer;
                    </script>";
            } else {
                $error = $conn->error;
                echo "<script>alert('Failed to remove restaurant: $error');
                    window.location=document.referrer;
                    </script>";
            }
        } else {
            $error = "Failed to retrieve maximum id.";
            echo "<script>alert('Failed to retrieve maximum id: $error');
                window.location=document.referrer;
                </script>";
        }
    }
}
?>
