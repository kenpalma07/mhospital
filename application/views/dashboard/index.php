<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Sidebar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #2E3B55;
            color: white;
            padding-top: 20px;
            position: fixed; /* Fix sidebar to the left */
            top: 0;
            left: 0;
            overflow-y: auto;
        }
        .sidebar h4 {
            font-size: 18px; /* Change this to your preferred size */
        }
        .sidebar .nav-link {
            color: white;
            padding: 10px;
            display: block;
            font-size: 10px;
        }
        .sidebar .nav-link:hover {
            background-color: #4A5B82;
            border-radius: 5px;
        }
        .active {
            background-color: #3A4A6B;
            border-radius: 5px;
        }
        .sidebar .section-title {
            padding-left: 10px;
            font-size: 12px;
            text-transform: uppercase;
            margin-top: 20px;
            color: #B0B7C3;
        }
        .content {
            margin-left: 270px; /* Adjust to match sidebar width */
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column">
        <h4 class="text-center">MY HOSPITAL</h4>
        <br>
        <div class="section-title">Transactions</div>
        <a href="<?php echo site_url('dashboard'); ?>" class="nav-link"><i class="fa fa-bed"></i>DASHBOARD</a>
        <a href="<?php echo site_url('patient'); ?>" class="nav-link"><i class="fas fa-bed"></i>PATIENT</a>
        <a href="outpatient.html" class="nav-link"><i class="fas fa-clinic-medical"></i>MEDICAL RECORDS</a>
    </div>

    <!-- Content Section -->
    <div class="content">
        <h1>Hi</h1>
        <p>Welcome to the dashboard.</p>
    </div>
</div>

<!-- Start of Script for Navigations -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const currentUrl = window.location.pathname;
    const links = document.querySelectorAll(".sidebar .nav-link");

    links.forEach(link => {
        // Check if the current URL contains the link's href
        if (currentUrl.includes(link.getAttribute("href"))) {
            link.classList.add("active");
        }
    });
});
</script>
<!-- End of Script for Navigations -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>