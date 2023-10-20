<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include the database configuration
    require_once '../../assets/config.php';

    // User input
    $nid = $_POST['nid'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

    // Insert into User table
    $userInsertQuery = "INSERT INTO User (username, password, level) VALUES ('$username', '$password', 'dosen')";
    if ($conn->query($userInsertQuery) === TRUE) {
        // Get the ID of the newly created user
        $user_id = $conn->insert_id;

        // Insert into Dosen table
        $dosenInsertQuery = "INSERT INTO Dosen (user_id, nid_dosen, nama_dosen, email) VALUES ($user_id, '$nid', '$nama', '$email')";
        if ($conn->query($dosenInsertQuery) === TRUE) {
            header("Location: ../daftar_dosen.php?success=tambah"); // Redirect to the success page
        } else {
            header("Location: ../daftar_dosen.php?error=tambah"); // Redirect to the error page
        }
    } else {
        header("Location: ../daftar_dosen.php?error=tambah"); // Redirect to the error page
    }

    // Close the database connection
    $conn->close();
} else {
    // Handle invalid request method
    echo "Invalid request method!";
}
?>
