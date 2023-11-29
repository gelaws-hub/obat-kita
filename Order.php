<?php
include('./constant/layout/head.php');
include('./constant/layout/header.php');
include('./constant/layout/sidebar.php');
include('./constant/connect.php');

$user = $_SESSION['userId'];

$sql = "SELECT o.id, o.orderDate, o.clientName, o.clientContact, o.paymentStatus, oi.productName, oi.quantity, p.rate, pr.product_name, b.brand_name
        FROM orders o
        JOIN order_item oi ON o.id = oi.lastid
        JOIN product p ON oi.productName = p.product_id
        JOIN product pr ON p.product_id = pr.product_id
        JOIN brands b ON p.brand_id = b.brand_id
        WHERE o.delete_status = 0";

$result = $connect->query($sql);
?>

<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary"> View Order</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">View Order</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="add-order.php"><button class="btn btn-primary">Add Order</button></a>
                <div class="table-responsive m-t-40">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Order Date</th>
                                <th>Client Name</th>
                                <th>Contact</th>
                                <th>Product Name</th>
                                <th>Brand</th>
                                <th>Quantity</th>
                                <th>Rate</th>
                                <th>Payment Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($result as $row) {
                                $no += 1;
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <?= $no; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['orderDate'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['clientName'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['clientContact'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['product_name'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['brand_name'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['quantity'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['rate'] ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row['paymentStatus'] == 1) {
                                            $paymentStatus = "<label class='label label-success'><h4>Full Payment</h4></label>";
                                            echo $paymentStatus;
                                        } else if ($row['paymentStatus'] == 2) {
                                            $paymentStatus = "<label class='label label-danger'><h4>Advance Payment</h4></label>";
                                            echo $paymentStatus;
                                        } else {
                                            $paymentStatus = "<label class='label label-warning'><h4>No Payment</h4></label>";
                                            echo $paymentStatus;
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php include('./constant/layout/footer.php'); ?>
    </div>
</div>