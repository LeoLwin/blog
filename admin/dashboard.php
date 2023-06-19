<?php

include "../components/connect.php";

session_start();

//$admin_id = $_SESSION["admin_id"];
$admin_id=1;

if (!isset($admin_id)) {
 header("location:admin_login.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashoard</title>
    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
<?php include "../components/admin_header.php"; ?>

        <!----admin dashboard section start --->

        <section class="dashboard">
            <h1 class="heading">Dashboard</h1>

            <div class="box-container">

                <div class="box">
                    <h3>welcome!</h3>
                    <p><?= $fetch_profile["name"] ?></p>
                    <a href="update_profile.php" class="btn">update profile</a>
                </div>

                <div class="box">
                    <?php
                    $select_posts = $conn->prepare(
                    "SELECT * FROM `posts` WHERE admin_id = ?");
                    $select_posts->execute([$admin_id]);
                    $numbers_of_posts = $select_posts->rowCount();
                    ?>
                    <h3><?= $numbers_of_posts ?></h3>
                    <p>posts added</p>
                    <a href="add_posts.php" class="btn">add new post</a>
                </div>

                
                <div class="box">
                    <?php
                    $select_active_posts = $conn->prepare(
                    "SELECT * FROM `posts` WHERE admin_id = ? AND status = ?"
                    );
                    $select_active_posts->execute([$admin_id, "active"]);
                    $numbers_of_active_posts = $select_active_posts->rowCount();
                    ?>
                    <h3><?= $numbers_of_active_posts ?></h3>
                    <p>active posts</p>
                    <a href="view_posts.php" class="btn">see posts</a>
                </div>

                <div class="box">
                    <?php
                    $select_deactive_posts = $conn->prepare(
                    "SELECT * FROM `posts` WHERE admin_id = ? AND status = ?"
                    );
                    $select_deactive_posts->execute([$admin_id, "deactive"]);
                    $numbers_of_deactive_posts = $select_deactive_posts->rowCount();
                    ?>
                    <h3><?= $numbers_of_deactive_posts ?></h3>
                    <p>deactive posts</p>
                    <a href="view_posts.php" class="btn">see posts</a>
                </div>


            </div>
        
        </section>
        <!----admin dashboard section end ---><div class="box">
         
        

    <!-- custom js file link  -->
<script src="../js/admin_script.js"></script>
</body>
</html>