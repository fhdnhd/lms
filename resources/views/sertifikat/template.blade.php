<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sertifikat</title>
<style>
    @page {
        size: A4 landscape;
        margin: 0;
    }
    body {
        margin:0;
        padding:0;
        font-family: 'Arial', sans-serif;
        position: relative;
        width: 100%;
        height: 100%;
    }
    .background {
        position: absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background-image: url("{{ public_path('sertifikat_bg.webp') }}");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        z-index: 0;
    }
    .content {
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 1;
        text-align: center;
    }

    

    .name {
        position: absolute;
        top: 45%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 60px;
        font-family: "Times New Roman", serif; /* contoh font elegan */
        font-style: italic; /* opsional */
        color: #d4af37; /* gold */
        text-shadow: 2px 2px 4px rgba(0,0,0,0.4);
    }
    .tanggal {
        position: absolute;
        top: 70%; /* sesuaikan posisi vertikal tanggal */
        left: 30%;
        transform: translate(-50%, -50%);
        font-size: 20px;
        color: #333;
        font-family: "Times New Roman", serif; /* contoh font elegan */
        font-style: italic; /* opsional */
    }
</style>
</head>
<body>
    <div class="background"></div>

    <div class="content">
        <div class="name">{{ $nama_user ?? 'Nama Peserta' }}</div>
        <div class="tanggal">{{ $tanggal ?? '00/00/0000' }}</div>
    </div>
</body>
</html>
