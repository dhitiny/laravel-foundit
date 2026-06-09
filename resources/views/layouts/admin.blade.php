<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manajemen User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        /* TEMA WARNA UTAMA KREM LURUS */
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #fdfbf7; 
            color: #2c3e50; 
        }
        
        /* NAVBAR UTAMA ADMIN */
        .navbar-admin { 
            background-color: #ffffff; 
            border-bottom: 2px solid #f1ece1;
            padding: 15px 0; 
        }
        .navbar-brand { 
            font-weight: 800; 
            font-size: 1.6rem; 
        }
        .brand-found { color: #8b0000; } /* MERAH */
        .brand-it { color: #041942; }    /* NAVY */

        /* UTALITAS KONTEN */
        .dashboard-header {
            background: linear-gradient(135deg, #041942 0%, #112d61 100%);
            color: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(4, 25, 66, 0.1);
        }

        /* CARD MANAJEMEN */
        .card-management {
            background: #ffffff;
            border: 1px solid #f1ece1;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.02);
            overflow: hidden;
        }

        /* DESIGN TABEL PROFESIONAL */
        .table-responsive {
            border-radius: 12px;
            overflow: hidden;
        }
        .table-custom-admin {
            margin-bottom: 0;
        }
        .table-custom-admin thead th {
            background-color: #041942;
            color: #ffffff;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            padding: 15px 20px;
            border: none;
        }
        .table-custom-admin tbody td {
            padding: 16px 20px;
            vertical-align: middle;
            color: #4a4a4a;
            border-bottom: 1px solid #f5efe4;
        }
        .table-custom-admin tbody tr:hover {
            background-color: #faf7f0;
        }

        /* CUSTOM SELECT DROP DOWN */
        .form-select-status {
            font-size: 0.8rem;
            font-weight: 600;
            border-radius: 8px;
            border: 1px solid #dcd3c1;
            padding: 6px 12px;
            background-color: #ffffff;
            color: #333;
            max-width: 130px;
        }
        .form-select-status:focus {
            border-color: #041942;
            box-shadow: 0 0 0 0.25rem rgba(4, 25, 66, 0.1);
        }

        /* ACTION BUTTON */
        .btn-update-status {
            background-color: #8b0000;
            color: white;
            border: none;
            font-weight: 600;
            font-size: 0.8rem;
            padding: 6px 15px;
            border-radius: 8px;
            transition: 0.2s;
        }
        .btn-update-status:hover {
            background-color: #660000;
            color: white;
        }
        .btn-back-home {
            border