<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phantom PHP Server </title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #121212;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        nav {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background: #1a1a1a;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 10;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
        }

        nav .nav-logo {
            display: flex;
            align-items: center;
            color: #39FF14;
            font-size: 24px;
            font-weight: 700;
            text-decoration: none;
        }

        nav .nav-logo img {
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }

        .github-button {
            background-color: #39FF14;
            border: none;
            color: #121212;
            padding: 10px 15px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            border-radius: 4px;
            text-decoration: none;
        }

        main {
            margin-top: 80px;
            text-align: center;
            z-index: 5;
            width: 100%;
        }

        .main-heading {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #39FF14;
            margin: 20px 0;
        }

        h2 {
            font-size: 36px;
            color: #39FF14;
            margin: 20px 0;
        }

        p {
            font-size: 18px;
            margin: 10px 0 20px;
        }

        .file-list {
            display: flex;
            flex-direction: column;
            background-color: #1e1e1e;
            width: 80%;
            max-width: 600px;
            padding: 20px;
            border-radius: 8px;
            overflow-y: auto;
            max-height: 400px;
        }

        .file-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            color: #b0b0b0;
            font-size: 16px;
            border-bottom: 1px solid #333;
        }

        .file-item:last-child {
            border-bottom: none;
        }

        .file-item i {
            color: #39FF14;
            font-size: 20px;
            margin-right: 10px;
        }

        .file-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            background-color: #39FF14;
            border: none;
            color: #121212;
            padding: 5px 10px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            border-radius: 4px;
        }

        .btn-delete {
            background-color: #ff3b3b;
        }

        footer {
            margin-top: 40px;
            font-size: 14px;
            color: #7a7a7a;
            text-align: center;
        }

        footer a {
            color: #39FF14;
            text-decoration: none;
            font-weight: bold;
        }

        .file-upload-form {
            margin: 20px 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .file-upload-form input[type="file"] {
            color: #ffffff;
        }
    </style>
</head>
<body>
    <nav>
        <a href="#" class="nav-logo">
            Phantom PHP Server
        </a>
        <a href="https://github.com/codetesla51/phantom-php" class="github-button">GitHub Repo</a>
    </nav>

    <main>
        <div class="main-heading">
            <h2>Phantom PHP Server </h2>
        </div>
        <p>We didn't find an index file at all during serving. We are using a temporary one with this. You can edit your files in the working directory, delete, or add new files. Delete this code from this page to start development.</p>

        <form class="file-upload-form" action="" method="POST" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" required>
            <button class="btn" type="submit" name="upload">Upload File</button>
        </form>

        <div class="file-list">
            <?php
                $directory = __DIR__;
                $files = array_diff(scandir($directory), array('.', '..', 'index.php'));

                // Handle file upload
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload'])) {
                    if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
                        $targetFile = $directory . '/' . basename($_FILES['fileToUpload']['name']);
                        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFile)) {
                            echo "<script>alert('File uploaded successfully!'); window.location.href=window.location.href;</script>";
                        } else {
                            echo "<script>alert('Failed to upload file.');</script>";
                        }
                    } else {
                        echo "<script>alert('No file selected or upload error.');</script>";
                    }
                }

                // Handle file deletion
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']) && isset($_POST['filename'])) {
                    $fileToDelete = $directory . '/' . $_POST['filename'];
                    if (file_exists($fileToDelete)) {
                        if (unlink($fileToDelete)) {
                            echo "<script>alert('File deleted successfully!'); window.location.href=window.location.href;</script>";
                        } else {
                            echo "<script>alert('Failed to delete file.');</script>";
                        }
                    } else {
                        echo "<script>alert('File not found.');</script>";
                    }
                }

                // List files with delete option
                foreach ($files as $file) {
                    echo "<div class='file-item'>
                            <i class='fas fa-file'></i> " . htmlspecialchars($file) . 
                            "<div class='file-actions'>
                                <form action='' method='POST' style='display:inline;'>
                                    <input type='hidden' name='filename' value='".htmlspecialchars($file)."'>
                                    <button type='submit' name='delete' class='btn btn-delete'>Delete</button>
                                </form>
                            </div>
                          </div>";
                }
            ?>
        </div>
    </main>

    <footer>
        <p>Phantom PHP Server made by <a href="https://github.com/codetesla51">Uthman Dev</a></p>
    </footer>
</body>
</html>

            
