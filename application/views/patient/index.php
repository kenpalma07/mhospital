<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patient List</title>
        <!-- Add Bootstrap & DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


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
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column">
        <h4 class="text-center">MY HOSPITAL</h4>
        <br>
        <div class="section-title">Transactions</div>
        <a href="<?php echo site_url('dashboard'); ?>" class="nav-link"><i class="fa fa-bed"></i> DASHBOARD</a>
        <a href="<?php echo site_url('patient'); ?>" class="nav-link"><i class="fa fa-bed"></i> PATIENT</a>
        <a href="outpatient.html" class="nav-link"><i class="fa fa-clinic-medical"></i>MEDICAL RECORDS</a>
    </div>

    <!-- Content Section -->
    <div class="content">
    <div class="container">
        <div class="container mt-4" style="font-size: 10px;">
            <h3 class="mb-3">PATIENT LIST</h3>

            <!-- Start Flash Success Message -->
            <?php if ($this->session->flashdata('success')): ?>
                <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
            <?php endif; ?>
            <!-- End Flass Success Messsage -->

            <table id="patientTable" class="table table-secondary table-striped table-bordered" style="width:100%; margin-top: 20px;; margin-bottom: 20px; size: 10px;">
            <div class="mb-2">
                <div class="col-md-12">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="<?php echo site_url('patient/add'); ?>" class="btn btn-success" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Add New Patient</a>
                    <a href="<?php echo site_url('patient/mrecord'); ?>" class="btn btn-success" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Medical Records</a>
                    <button type="button" class="btn btn-success" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" data-bs-toggle="modal" data-bs-target="#addPatientModal">
                        Test Add New Patient
                    </button>
                    <a href="<?php echo site_url('Auth/logout'); ?>" class="btn btn-danger" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Logout</a>

                </div>
            </div>
            <thead>
                <th>ID</th>
                <th>Profile Image</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Sex</th>
                <th>Birth Date</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Date Registered</th>
                <!-- <th>Updated At</th> -->
                <!-- <th>Deleted At</th> -->
                <th>Status</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient): ?>
                <tr>
                    <td><?php echo $patient['id']; ?></td>
                    <td>
                    <!-- <a href="#" class="view-patient-btn" data-id="<?php // echo $patient['id']; ?>">
                        <i class="material-icons account-icon" id="accountIcon" style="font-size: 20px;">account_circle</i>
                    </a> -->
                        <!-- <img src="<?php //echo base_url($patient['profile_image']); ?>" width="40"> -->
                        <div class="text-center mx-auto">
                            <div class="image-containers">
                                <img src="<?php echo base_url($patient['profile_image']); ?>" alt="No Image" class="border border-success border-1">
                            </div>
                        </div>
                    </td>
                    <td><?php echo $patient['firstname']; ?></td>
                    <td><?php echo $patient['middlename']; ?></td>
                    <td><?php echo $patient['lastname']; ?></td>
                    <td><?php echo $patient['sex']; ?></td>
                    <td><?php echo $patient['birthdate']; ?></td>
                    <td><?php echo $patient['email']; ?></td>
                    <td><?php echo $patient['phone']; ?></td>
                    <td><?php echo $patient['created_at']; ?></td>
                    <!-- <td><?php //echo $patient['updated_at']; ?></td> -->
                    <!-- <td><?php //echo $patient['deleted_at']; ?></td> -->
                    <td><?php echo $patient['status']; ?></td>
                    <td>
                        <a href="<?php echo site_url('patient/edit/'.$patient['id']); ?>">Edit</a> |
                        <a href="<?php echo site_url('patient/soft_delete/'.$patient['id']); ?>" onclick="return confirm('Are you sure?');">Discharge</a> |
                        <!-- <a href="#" class="view-patient-btn" data-id="<?php //echo $patient['id']; ?>">
                            View Patient
                        </a> | -->
                        <a href="#" onclick="viewPatient(<?php echo ($patient['id']); ?>)" data-bs-toggle="modal" data-bs-target="#patientModal">View Patient</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addPatientModal" tabindex="-1" aria-labelledby="addPatientModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="addPatientModalLabel">ADD NEW PATIENT</h5> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="modal-content">
                        <!-- Content will be loaded here via AJAX -->
                        <p>Loading...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Generic Bootstrap Modal -->
    <!-- <div class="modal fade" id="patientModal" tabindex="-1" aria-labelledby="patientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="patientModalLabel">VIEW PATIENT INFORMATION</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="modalContent"></div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Start View Modal -->
    <div class="modal fade" id="patientModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">PATIENT DETAILS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="color: #198754;">

                <p class="text-center"><strong>Name:</strong> <span id="patientName"></span></p>
                
                <ul class="list-group" style="font-size: 12px;">
                    <li class="list-group-item d-flex justify-content-between" style="color: #198754;">
                        <strong>BIRTHDATE:</strong>
                        <span id="patientBirthdate"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between" style="color: #198754;">
                        <strong>EMAIL:</strong>
                        <span id="patientEmail"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between" style="color: #198754;">
                        <strong>PHONE:</strong>
                        <span id="patientPhone"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between" style="color: #198754;">
                        <strong>SEX:</strong>
                        <span id="patientSex"></span>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    <!-- End View Modal -->
    </div>
</div>

    <!-- Add jQuery, DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Start Style -->
    <style>
        .account-icon {
            color: gray; /* Default color */
            transition: color 0.3s ease-in-out;
        }
        
        .account-icon:hover {
            color: black; /* Change color on hover */
        }

        .image-containers {
            width: 30px; /* Set fixed width */
            height: 30px; /* Set fixed height */
            overflow: hidden; /* Hide overflowing parts */
            border-radius: 0px; /* Optional: for rounded corners */
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto; /* Centers the container itself */
        }

        .image-containers img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensures image covers the area without stretching */
            transition: transform 0.3s ease-in-out;
        }

        .image-containers:hover img {
            transform: scale(1.2); /* Zoom in on hover */
        }
    </style>

    <script>
        $(document).ready(function() {
            $('#patientTable').DataTable();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            $('#addPatientModal').on('show.bs.modal', function () {
                $('#modal-content').load("<?php echo site_url('patient/add'); ?>");
            });
        });
    </script>

    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script>
        // $(document).ready(function(){
        //     $(".view-patient-btn").click(function(){
        //         var patientId = $(this).data("id"); // Get patient ID from button
        //         $("#modalContent").html('<p class="text-center">Loading...</p>'); // Show loading text

        //         $.ajax({
        //             url: "<?php //echo site_url('patient/view_patient'); ?>/" + patientId, 
        //             type: "GET",
        //             success: function(response){
        //                 $("#modalContent").html(response); // Load content into modal
        //                 $("#patientModal").modal("show"); // Show modal
        //             },
        //             error: function(){
        //                 $("#modalContent").html("<p class='text-danger'>Failed to load patient details.</p>");
        //             }
        //         });
        //     });
        // });

        function viewPatient(id) {
    console.log("Fetching patient ID:", id);
    
    $.ajax({
        url: "<?php echo base_url('patient/getPatientByID'); ?>/" + id, // Fix function name
        type: "GET",
        dataType: "json",
        success: function(response) {
            if (response) {
                $("#patientName").text(response.name);
                $("#patientBirthdate").text(response.birthday);
                $("#patientEmail").text(response.email);
                $("#patientPhone").text(response.phone);
                $("#patientSex").text(response.sex);

                console.log("Profile Image URL:", response.photo);

                // Update image source dynamically
                let imageSrc = response.photo ? "<?php echo base_url('uploads/'); ?>" + response.photo : "<?php echo base_url('uploads/default-profile.png'); ?>";
                $("#patientProfileImage").attr("src", imageSrc);


                // Show the modal
                $("#patientModal").modal("show");
            }
        },
        error: function() {
            alert("Failed to load patient details!");
        }
    });
}
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const currentUrl = window.location.href;
            document.querySelectorAll(".sidebar .nav-link").forEach(link => {
                if (currentUrl.includes(link.href)) {
                    link.classList.add("active");
                }
            });
    });

</script>


</body>
</html>
