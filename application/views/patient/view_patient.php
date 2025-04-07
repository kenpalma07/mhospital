<html>
<header>
    <title>View Patient</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        .info-card {
            border: 1px solid #198754; /* Green border */
            padding: 15px;
            border-radius: 10px;
        }
        .info-item {
            display: flex;
            align-items: center;
            padding: 8px 0;
            justify-content: start;
        }
        .info-item i {
            font-size: 20px;
            color: #198754; /* Green icons */
            margin-right: 10px;
        }
        .info-item strong {
            color: #198754; /* Green text */
            font-weight: bold;
            margin-right: 5px;
        }
        .info-item span {
        color: #198754; /* Ensure the value is readable */
        }
    </style>
</header>

<body>
    <div class="container">
        <div class="row mb-3">
            <div class="text-center mx-auto">
                <div class="image-container">
                <img src="<?php echo base_url($patient['profile_image']); ?>" alt="No Image" class="border border-success border-5">
                </div>
            </div>    
        </div>
        <div class="row">
            <div class="text-center text-success mx-auto">
                <h5><?php echo $patient['firstname'] . ' ' . $patient['middlename'] . ' ' . $patient['lastname']; ?></h5>
            </div>
        </div>
        <div class="row mb-3" style="font-size: 12px;">
            <div class="container mt-4">
                <div class="info-card">
                    <div class="d-flex justify-content-between align-items-center info-item">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-calendar"></i>
                            <strong class="ms-2">BIRTH DATE:</strong>
                        </div>
                        <span><?php echo $patient['birthdate'] ?></span> <!-- Value pushed to the right -->
                    </div>
                    <div class="d-flex justify-content-between align-items-center info-item">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-envelope"></i>
                            <strong class="ms-2">EMAIL:</strong>
                        </div>
                        <span><?php echo $patient['email'] ?></span> <!-- Value pushed to the right -->
                    </div>
                    <div class="d-flex justify-content-between align-items-center info-item">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-phone"></i>
                            <strong class="ms-2">PHONE:</strong>
                        </div>
                        <span><?php echo $patient['phone'] ?></span> <!-- Value pushed to the right -->
                    </div>
                    <div class="d-flex justify-content-between align-items-center info-item">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user"></i>
                            <strong class="ms-2">REGISTERED:</strong>
                        </div>
                        <span><?php echo $patient['created_at'] ?></span> <!-- Value pushed to the right -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .image-container {
            width: 300px; /* Set fixed width */
            height: 250px; /* Set fixed height */
            overflow: hidden; /* Hide overflowing parts */
            border-radius: 0px; /* Optional: for rounded corners */
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto; /* Centers the container itself */
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensures image covers the area without stretching */
            transition: transform 0.3s ease-in-out;
        }

        .image-container:hover img {
            transform: scale(1.2); /* Zoom in on hover */
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>