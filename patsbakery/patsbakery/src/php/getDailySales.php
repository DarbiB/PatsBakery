<?php
 require_once "config.php";

 $orders = [];

 $conn = new mysqli($hn,$un,$pw,$db);

 if($conn->connect_error) {
    $res["status"] = "error";
    $res["status_message"] = "MySQL connection error";
 } else {
    $stmt = $conn->prepare("SELECT * FROM orders WHERE orders.date = CURDATE();");
    if($stmt->execute()) {
        $result = $stmt->get_result();

        $rows = $result->num_rows;

        if($rows >= 1) {
            foreach($result as $order) {
                $id = $order["id"];

                $stmt = $conn->prepare("SELECT * FROM orderdetail WHERE order_id=$id");

                if($stmt->execute()) {
                    $result = $stmt->get_result();
                    $rows = $result->num_rows;
                    $products = []; //Need to re-initialize as empty so orders toward the 
                                    //bottom don't show products from orders towards the top
                    if($rows >= 1) {
                        foreach($result as $product) {
                            $products[] = $product;
                        }
                        $order["products"] = $products;
                    } else {
                        $order["products"] = [];
                        $res["status"] = "error";
                        $res["status_message"] = "No products found.";
                    }

                    $orders[] = $order;

                    $res["status"] = "success";
                    $res["orders"] = $orders;
                } else {
                    $res["status"] = "error";
                    $res["status_message"] = $stmt->error;
                }
            }
        } else {
            $res["status"] = "error";
            $res["status_message"] = "No Products found.";
        }
    } else {
        $res["status"] = "error";
        $res["status_message"] = $stmt->error;
    }
}
echo json_encode($res);


?>