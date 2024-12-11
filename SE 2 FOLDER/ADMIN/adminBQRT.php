<?php
    include ('../DATABASE/connect.php');

    $official_id = "";
    $official_name = "";
    $official_info = "";
    $official_contact = "";
    $official_photo = "";

    // Handle form submission
    if(isset($_POST['submit'])) {
        $official_id = $_POST['official_id'];
        $official_name = $_POST['official_name'];
        $official_info = $_POST['official_info'];
        $official_contact = $_POST['official_contact'];

        // Handle photo upload if a new file is provided
        if (!empty($_FILES['official_photo']['name'])) {
            $target_dir = "../MEDIA/";
            $target_file = $target_dir . basename($_FILES['official_photo']['name']);
            if (move_uploaded_file($_FILES['official_photo']['tmp_name'], $target_file)) {
                $official_photo = basename($_FILES['official_photo']['name']);
            } else {
                die("Error uploading the photo.");
            }
        } else {
            // Retain the existing photo if no new file is uploaded
            $official_photo = $_POST['existing_photo'];
        }

        // Determine if it is an insert or update operation
        if ($official_id == 0) {
            $qry = "INSERT INTO admin (official_name, official_info, official_contact, official_photo) VALUES ('$official_name', '$official_info', '$official_contact', '$official_photo')";
        } else {
            $qry = "UPDATE admin SET official_name='$official_name', official_info='$official_info', official_contact='$official_contact', official_photo='$official_photo' WHERE official_id='$official_id'";
        }

        $result = $conn->query($qry);
        if (!$result) {
            die("Query failed: " . $conn->error);
        }

        header('location: adminBQRT.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - BQRT</title>
    <link rel="stylesheet" href="../ASSETS/adminBQRT.css">
</head>
<body>
    <header>
        <img src="../HOME PAGE/Lecheria Logo.png" alt="Digital Barangay Logo">
        <h1>Barangay Quick Response Team (BQRT) - Admin</h1>
    </header>
    <nav>
        <a href="../ADMIN/ADMIN.php">ADMIN</a>
        <a href="adminBQRT.php">BQRT</a>
        <a href="adminOFFICIALS.php">BRGY OFFICIALS</a>
        <a href="../HOME PAGE/Home Page.php">LOG OUT</a>
    </nav>
    <div class="container">
        <section class="team">
            <div class="team-leader">
                <?php
                    // Retrieve BQRT Leader data
                    $qry = "SELECT * FROM admin WHERE official_info = 'BQRT Leader'";
                    $results = $conn->query($qry);
                    if (!$results) {
                        die("Invalid query: " . $conn->error);
                    }
                    while ($row = $results->fetch_assoc()) {
                        ?>
                        <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="official_id" value="<?php echo $row['official_id']; ?>">
                        <input type="hidden" name="existing_photo" value="<?php echo $row['official_photo']; ?>">
                        <div class="chairman">
                            <img src="../MEDIA/<?php echo $row['official_photo']; ?>" alt="Barangay Chairman Photo">
                            <h3><input type="text" name="official_name" value="<?php echo $row['official_name']; ?>"></h3>
                            <p><input type="text" name="official_info" value="<?php echo $row['official_info']; ?>"></p>
                            <p><strong>Contact: </strong> <input type="text" name="official_contact" value="<?php echo $row['official_contact']; ?>"></p>
                            <label>Upload Photo:</label>
                            <input type="file" name="official_photo">
                            <button type="submit" name="submit">Save Changes</button>
                        </div>
                    </form>
                    <?php
                    }    
                ?>
            </div>
            <div class="members">
                <?php
                    // Retrieve BQRT members
                    $qry = "SELECT * FROM admin WHERE official_info = 'BQRT'";
                    $results = $conn->query($qry);
                    if (!$results) {
                        die("Invalid query: " . $conn->error);
                    }
                    while ($row = $results->fetch_assoc()) {
                        ?>
                        <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="official_id" value="<?php echo $row['official_id']; ?>">
                        <input type="hidden" name="existing_photo" value="<?php echo $row['official_photo']; ?>">
                        <div class="member">
                            <img src="../MEDIA/<?php echo $row['official_photo']; ?>" alt="Member">
                            <h3><input type="text" name="official_name" value="<?php echo $row['official_name']; ?>"></h3>
                            <p><input type="text" name="official_info" value="<?php echo $row['official_info']; ?>"></p>
                            <p><strong>Contact: </strong><input type="text" name="official_contact" value="<?php echo $row['official_contact']; ?>"></p>
                            <label>Upload Photo:</label>
                            <input type="file" name="official_photo">
                            <button type="submit" name="submit">Save Changes</button>
                        </div>
                    </form>
                    <?php
                    }    
                ?>
            </div>
        </section>
    </div>
    <footer>
        <p>&copy; 2024 Barangay Quick Response Team. All Rights Reserved.</p>
    </footer>
</body>
</html>
