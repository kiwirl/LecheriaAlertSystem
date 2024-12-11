<?php
    include ('../DATABASE/connect.php');

    $official_id = "";
    $official_name = "";
    $official_info = "";
    $official_contact = "";
    $official_photo = "";

    // Handle form submission
    if(isset($_POST['submit'])) {
        // Retrieve the selected type from the form
        $official_id = $_POST['official_id'];
        $official_name = $_POST['official_name'];
        $official_info = $_POST['official_info'];
        $official_contact = $_POST['official_contact'];

        // Handle photo upload if a new file is provided
        if ($_FILES['official_photo']['name'] != "") {
            $photo_name = $_FILES['official_photo']['name'];
            $photo_tmp = $_FILES['official_photo']['tmp_name'];
            $photo_path = "../MEDIA/" . $photo_name;
            move_uploaded_file($photo_tmp, $photo_path);
            $official_photo = $photo_name;
        } else {
            // If no new photo is uploaded, retain the old photo
            $official_photo = $_POST['existing_photo'];
        }

        if ($_POST['official_id'] == 0) {
            // Insert new official if no ID is provided
            $qry = "INSERT INTO admin (official_name, official_info, official_contact, official_photo) 
                    VALUES ('$official_name', '$official_info', '$official_contact', '$official_photo')";
        } else {
            // Update existing official details
            $qry = "UPDATE admin SET official_name='$official_name', official_info='$official_info', official_contact='$official_contact', official_photo='$official_photo' WHERE official_id='$official_id'";
        }
        
        $result = $conn->query($qry);
        header('location: adminOFFICIALS.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Officials - Admin Page</title>
    <link rel="stylesheet" href="../ASSETS/adminOFFICIALS.css">
</head>
<body>
    <header>
        <img src="../HOME PAGE/Lecheria Logo.png" alt="Barangay Logo">
        <h1>Barangay Officials - Admin Page</h1>
    </header>

    <nav>
        <a href="../ADMIN/ADMIN.php">ADMIN</a>
        <a href="adminBQRT.php">BQRT</a>
        <a href="adminOFFICIALS.php">BRGY OFFICIALS</a>
        <a href="../HOME PAGE/Home Page.php">LOG OUT</a>
    </nav>

    <div class="container">
        <section class="brgy-officials">
            <!-- Editable Barangay Chairman -->
            <?php
                $qry = "SELECT * FROM admin WHERE official_info LIKE '%Captain%'";
                $results = $conn->query($qry);

                if (!$results) {
                    die("Invalid query: " .$conn->error);
                }

                while ($row = $results->fetch_assoc()) {
                    ?>
                    <form id="my-form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="official_id" value="<?php echo $row['official_id']; ?>" class="form-control">
                    <input type="hidden" name="existing_photo" value="<?php echo $row['official_photo']; ?>">
                    <div class="chairman">
                        <img id="chairman-photo-preview" src="../MEDIA/<?php echo $row['official_photo']; ?>" alt="Barangay Chairman Photo">
                        <h3><input type="text" id="chairman-name" name="official_name" value="<?php echo $row['official_name']; ?>"></h3>
                        <p><input type="text" id="chairman-position" name="official_info" value="<?php echo $row['official_info']; ?>"></p>
                        <p><strong>Contact: </strong> <input type="text" id="chairman-contact" name="official_contact" value="<?php echo $row['official_contact']; ?>"></p>
                        <label for="chairman-photo">Upload Photo:</label>
                        <input type="file" id="chairman-photo" name="official_photo" value="<?php echo $row['official_photo']; ?>">
                        <button type="submit" name="submit">Save Changes</button>
                    </div>
                </form>
                <?php
                }    
            ?>

            <!-- Officials Section (excluding BQRT and Chairman) -->
            <div class="officials" id="officials-list">
                <?php
                    $qry = "SELECT * FROM admin WHERE official_info NOT LIKE '%BQRT%' AND official_info NOT LIKE '%Kapitan%'" ;
                    $results = $conn->query($qry);

                    if (!$results) {
                        die("Invalid query: " .$conn->error);
                    }

                    while ($row = $results->fetch_assoc()) {
                        ?>
                        <form id="my-form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="official_id" value="<?php echo $row['official_id']; ?>" class="form-control">
                        <input type="hidden" name="existing_photo" value="<?php echo $row['official_photo']; ?>">
                        <div class="official">
                            <img id="official-photo-preview" src="../MEDIA/<?php echo $row['official_photo']; ?>" alt="Official">
                            <h3><input type="text" value="<?php echo $row['official_name']; ?>" name="official_name"></h3>
                            <p><input type="text" value="<?php echo $row['official_info']; ?>" name="official_info"></p>
                            <p><strong>Contact: </strong> <input type="text" value="<?php echo $row['official_contact']; ?>" name="official_contact"></p>
                            <label for="official-photo">Upload Photo:</label>
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
    <form method="post">
        <input type="hidden" name="official_id" value="0" class="form-control">
        <button class="add-member-btn" type="submit" name="submit">+</button>
    </form>
    <footer>
        <p>&copy; 2024 Barangay Lecheria</p>
    </footer>
</body>
</html>
