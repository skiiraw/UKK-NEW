<?php
include_once("config.php");

/**
 * Legitimate websites always check if the ID is valid 
 * before trying to touch the database.
 */
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // 1. Securely fetch the filename using a Prepared Statement
    $stmt_select = $mysqli->prepare("SELECT foto_filename FROM siswa WHERE id = ?");
    $stmt_select->bind_param("i", $id);
    $stmt_select->execute();
    $result = $stmt_select->get_result();
    $data = $result->fetch_assoc();
    $stmt_select->close();

    if ($data) {
        $foto_filename = $data['foto_filename'];

        // 2. Delete the record
        $stmt_delete = $mysqli->prepare("DELETE FROM siswa WHERE id = ?");
        $stmt_delete->bind_param("i", $id);

        if ($stmt_delete->execute()) {
            // 3. Clean up the physical file
            if (!empty($foto_filename)) {
                $file_path = "uploads/" . $foto_filename;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            
            // Success! Redirect back to the main list
            header("Location: index.php?status=deleted");
            exit();
        } else {
            $error_message = "Gagal menghapus data dari database.";
        }
        $stmt_delete->close();
    } else {
        $error_message = "Data siswa tidak ditemukan.";
    }
} else {
    $error_message = "ID tidak valid.";
}

/**
 * If the code reaches this point, it means an error occurred.
 * We show a styled error page that matches your beige theme.
 */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Error | Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #a8947e;
            --primary-hover: #8e7d6a;
            --bg-body: #fdfaf5;
            --bg-card: #ffffff;
            --border-beige: #f2e9dc;
            --text-main: #4a443e;
            --text-muted: #9c9185;
            --accent-delete: #e07a5f;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-body);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .error-card {
            background: var(--bg-card);
            padding: 40px;
            border-radius: 24px;
            border: 1.5px solid var(--border-beige);
            box-shadow: 0 15px 40px rgba(168, 148, 126, 0.08);
            text-align: center;
            max-width: 400px;
            animation: slideUp 0.6s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        h2 {
            color: var(--accent-delete);
            margin-bottom: 10px;
            font-weight: 600;
        }

        p {
            color: var(--text-muted);
            margin-bottom: 25px;
        }

        .btn {
            text-decoration: none;
            background: var(--primary);
            color: white;
            padding: 10px 25px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(168, 148, 126, 0.2);
        }
    </style>
</head>
<body>
    <div class="error-card">
        <h2>Oops!</h2>
        <p><?php echo $error_message; ?></p>
        <a href="index.php" class="btn">Kembali ke Beranda</a>
    </div>
</body>
</html>
