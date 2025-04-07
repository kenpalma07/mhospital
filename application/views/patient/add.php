<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Patient</title>
    
    <!-- Bootstrap & DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
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
        <div class="container">
            <div class="container mt-2" style="font-size: 10px;">
                <h5>ADD PATIENT</h5>
                
                <?php echo validation_errors(); ?>
                
                <!-- Fix: Add enctype for file upload -->
                <?php echo form_open('patient/add', ['method' => 'post', 'enctype' => 'multipart/form-data']); ?>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input class="form-control" type="file" id="profile_image" name="profile_image" accept="image/*">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <label>First Name:</label>
                        <input type="text" name="firstname" value="<?php echo set_value('firstname'); ?>" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>Middle Name:</label>
                        <input type="text" name="middlename" value="<?php echo set_value('middlename'); ?>" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>Last Name:</label>
                        <input type="text" name="lastname" value="<?php echo set_value('lastname'); ?>" class="form-control">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <label for="sex">Sex:</label>
                        <select name="sex" class="form-select" required>
                            <option value="">Select Sex</option>
                            <option value="M" <?php echo set_value('sex') == 'M' ? 'selected' : ''; ?>>Male</option>
                            <option value="F" <?php echo set_value('sex') == 'F' ? 'selected' : ''; ?>>Female</option>
                        </select><br>
                    </div>
                    <div class="col-md-4">
                        <label>Birth Date:</label>
                        <input type="date" name="birthdate" value="<?php echo set_value('birthdate'); ?>" class="form-control">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <label>Email:</label>
                        <input type="text" name="email" value="<?php echo set_value('email'); ?>" class="form-control"><br>
                    </div>
                    <div class="col-md-6">
                        <label>Phone:</label>
                        <input type="text" name="phone" value="<?php echo set_value('phone'); ?>" class="form-control"><br>
                    </div>
                </div>
                
                <div class="row">
                    <div class="btn-group col-md-4" role="group">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="<?php echo site_url('patient'); ?>" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
                
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
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
</body>
</html>
