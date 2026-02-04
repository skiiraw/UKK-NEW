<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa | Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #a8947e;
            --primary-hover: #8e7d6a;
            --bg-body: #fdfaf5;
            --bg-card: #ffffff;
            --border-beige: #f2e9dc;
            --text-main: #4a443e;
            --text-muted: #9c9185;
            --white: #ffffff;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-container {
            background: var(--bg-card);
            max-width: 600px;
            width: 100%;
            padding: 40px;
            border-radius: 24px;
            border: 1.5px solid var(--border-beige);
            box-shadow: 0 15px 40px rgba(168, 148, 126, 0.08);
            animation: slideUp 0.6s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        .header-section {
            margin-bottom: 30px;
        }

        .btn-back {
            text-decoration: none;
            color: var(--text-muted);
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            margin-bottom: 15px;
            transition: color 0.3s;
        }

        .btn-back:hover { color: var(--primary); }

        h2 {
            margin: 0;
            font-weight: 600;
            font-size: 1.5rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        input[type=text], 
        input[type=number] {
            width: 100%;
            padding: 12px 16px;
            box-sizing: border-box;
            border: 1.5px solid var(--border-beige);
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            color: var(--text-main);
            transition: all 0.3s;
            background: #fafaf9;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(168, 148, 126, 0.1);
        }

        /* Image Preview Section */
        .photo-preview-wrapper {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 15px;
            background: #fdfbf8;
            border-radius: 16px;
            border: 1px dashed var(--border-beige);
        }

        .current-photo {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 16px;
            border: 2px solid var(--white);
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .submit-btn {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .submit-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(168, 148, 126, 0.2);
        }
    </style>
</head>
<body>

<div class="form-container">
    <div class="header-section">
        <a href="index.php" class="btn-back">← Kembali ke Daftar</a>
        <h2>Registrasi Siswa Baru</h2>
    </div>

    <form action="proses_tambah.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" placeholder="Contoh: Budi Santoso" required>
        </div>

        <div style="display: flex; gap: 20px;">
            <div class="form-group" style="flex: 1;">
                <label>No. Presensi</label>
                <input type="number" name="nomor_presensi" placeholder="00" required>
            </div>
            <div class="form-group" style="flex: 2;">
                <label>Kelas</label>
                <input type="text" name="kelas" placeholder="Contoh: XI RPL 1" required>
            </div>
        </div>

        <div class="form-group">
            <label>Foto Identitas</label>
            <div class="photo-preview-wrapper">
                <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiBmaWxsPSIjZWVlIi8+Cjx0ZXh0IHg9IjUwIiB5PSI1NSIgZm9udC1mYW1pbHk9IkFyaWFsLCBzYW5zLXNlcmlmIiBmb250LXNpemU9IjEwIiBmaWxsPSIjOTk5IiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBkeT0iMC4zZW0iPk5vIFBob3RvPC90ZXh0Pgo8L3N2Zz4=" class="current-photo" id="previewImg" alt="No Photo">
                
                <div style="flex: 1;">
                    <p style="margin: 0 0 8px 0; font-size: 12px; color: var(--text-muted);">Pilih foto siswa</p>
                    <input type="file" name="foto" id="fotoInput" accept="image/*" required>
                </div>
            </div>
        </div>

        <button type="submit" name="submit" class="submit-btn">Tambah Siswa Baru</button>
    </form>
</div>

<script>
    // Live Image Preview script
    const fotoInput = document.getElementById('fotoInput');
    const previewImg = document.getElementById('previewImg');

    fotoInput.onchange = evt => {
        const [file] = fotoInput.files;
        if (file) {
            previewImg.src = URL.createObjectURL(file);
        }
    }
</script>

</body>
</html>
