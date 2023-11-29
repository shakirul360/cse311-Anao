<?php
session_start();
include 'connectdb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['addtoMenu'])) {
        $type = $_POST["foodType"];
        $foodName = $_POST["name"];
        $foodDesc = $_POST["description"];
        $foodPrice = $_POST["price"];

        $restId = $_SESSION['rest_id'];
        
      
        $restNameQuery = "SELECT restaurant_name FROM `rest_reg` WHERE id = '$restId'";
        $restNameResult = mysqli_query($conn, $restNameQuery);
        
        if ($restNameResult && mysqli_num_rows($restNameResult) > 0) {
            $restNameData = mysqli_fetch_assoc($restNameResult);
            $restName = $restNameData['restaurant_name'];
            
            $sql = "INSERT INTO `menu` (`food_name`, `category`, `price`, `description`, `ResID`, `ResName`) VALUES ('$foodName', '$type', '$foodPrice', '$foodDesc', '$restId', '$restName')";
            $result = mysqli_query($conn, $sql);
            $foodId = mysqli_insert_id($conn);

            if ($result) {
                $check = getimagesize($_FILES["image"]["tmp_name"]);

                if ($check !== false) {
                    $newName = 'food-' . $foodId;
                    $newfilename = 'food-' . $foodId . '.jpg';

                    $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/anao_main/restaurant/images/';
                    $uploadfile = $uploaddir . $newfilename;

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                        echo "<script>alert('Success');
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
                echo "<script>alert('Failed to add food to the menu.');
                    window.location=document.referrer;
                </script>";
            }
        } else {
            echo "<script>alert('Failed to retrieve restaurant name.');
                window.location=document.referrer;
            </script>";
        }
    } elseif (isset($_POST['removeFood'])) {

        $foodId = $_POST["foodId"];
        $filename = $_SERVER['DOCUMENT_ROOT'] . "/anao_main/restaurant/images/food-" . $foodId . ".jpg";

        // Step 1: Delete the row
        $sqlDelete = "DELETE FROM menu WHERE food_Id = '$foodId'";
        $resultDelete = $conn->query($sqlDelete);

        if ($resultDelete) {
            if (file_exists($filename)) {
                unlink($filename);
            }

            echo "<script>alert('Removed!');
                window.location=document.referrer;
                </script>";
        } else {
            $error = $conn->error;
            echo "<script>alert('Failed to remove food: $error');
                window.location=document.referrer;
                </script>";
        }
    } elseif (isset($_POST['updateFood'])) {

        $foodId = $_POST["foodId"];
        $foodName = $_POST["name"];
        $type = $_POST["foodType"];
        $foodDesc = $_POST["description"];
        $foodPrice = $_POST["price"];

        $sql = "UPDATE `menu` SET `food_name`='$foodName', `category`='$type', `price`='$foodPrice', `description`='$foodDesc' WHERE `food_Id`='$foodId'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>alert('Update successful');
                window.location=document.referrer;
                </script>";
        } else {
            echo "<script>alert('Failed to update food');
                window.location=document.referrer;
                </script>";
        }
    } elseif (isset($_POST['updateFoodPhoto'])) {
        $foodId = $_POST["foodId"];
        $check = getimagesize($_FILES["foodImage"]["tmp_name"]);
        if ($check !== false) {
            $newName = 'food-' . $foodId;
            $newfilename = $newName . ".jpg";

            $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/anao_main/restaurant/images/';
            $uploadfile = $uploaddir . $newfilename;

            if (move_uploaded_file($_FILES['foodImage']['tmp_name'], $uploadfile)) {
                echo "<script>alert('Image updated successfully');
                        window.location=document.referrer;
                    </script>";
            } else {
                echo "<script>alert('Failed to update image');
                        window.location=document.referrer;
                    </script>";
            }
        } else {
            echo '<script>alert("Please select an image file to upload.");
            window.location=document.referrer;
                </script>';
        }
    }
}
?>
