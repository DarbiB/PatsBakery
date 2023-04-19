<?php
require_once "config.php";

// $session = $_POST["session"];

// session_id($session);
// session_start();

//$auth = $_SESSION["auth"];

$id = null;
//$employee_id = $_SESSION["id"];
$date = $_POST["date"];
$employeeName = $_POST["employeeName"];
$customerName = $_POST["customerName"];
$customerContact = $_POST["customerContact"];
$products = json_decode($_POST["products"], true);

// if ($auth) {
    $conn = new mysqli($hn,$un,$pw,$db);

    if($conn->connect_error) {
        $res["status"] = "error";
        $res["status_message"] = "MySQL connection error";
    } else {
        $stmt = $conn->prepare("INSERT INTO orders VALUES(?,?,?,?,?)");
        $stmt->bind_param("issss",$id,$employeeName,$customerName,$customerContact,$date);

        if($stmt->execute()) {
            $order_id = $conn->insert_id;

            foreach($products as $product) {
                $id = null;
                $name = $product["name"];
                $quantity = $product["quantity"];

                $stmt = $conn->prepare("INSERT INTO orderdetail VALUES(?,?,?,?)");
                $stmt->bind_param("iisi",$id,$order_id,$name,$quantity);

                if($stmt->execute()) {
                    $res["status"] = "success";
                } else {
                    $res["status"] = "error";
                    $res["status_message"] = $stmt->error;
                }
            }
        }else {
            $res["status"] = "error";
            $res["status_message"] = 
            $stmt->error;
        }
    }
// } else {
//     $res["status"] = "error";
//     $res["status_message"] = "Not authenticated.";
// }

echo json_encode($res);

?>