<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Panel CBT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
    width: 250px;
    min-height: 100vh;
    position: fixed;
    background-color: #343a40;
    color: white;
    transition: transform 0.3s ease;
    z-index: 1000;
}

.sidebar.hidden {
    transform: translateX(-100%);
}

.main-content {
    margin-left: 250px;
    transition: margin-left 0.3s ease;
    width: calc(100% - 250px);
}

.main-content.full {
    margin-left: 0;
    width: 100%;
}


        .navbar-dashboard {
            background-color: #343a40;
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #444;
        }

        .logout-link {
            color: white;
            text-decoration: none;
        }

        .logout-link:hover {
            text-decoration: underline;
        }

                /* Layout responsif */
        .main-content {
            margin-left: 250px;
            width: calc(100% - 250px);
            transition: all 0.3s ease;
        }

        .main-content.full {
            margin-left: 0;
            width: 100%;
        }

        /* Footer */
        #mainFooter {
            transition: all 0.3s ease;
            margin-left: 250px;
            width: calc(100% - 250px);
        }

        #mainFooter.full-footer {
            margin-left: 0;
            width: 100%;
        }

    </style>
</head>
<body>
