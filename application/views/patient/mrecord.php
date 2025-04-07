<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Medical Records</title>
        <!-- Add Bootstrap & DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="container mt-4" style="font-size: 10px;">
            <h3 class="mb-3">MEDICAL RECORDS</h3>

            <!-- Start Flash Success Message -->
            <?php if ($this->session->flashdata('success')): ?>
                <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
            <?php endif; ?>
            <!-- End Flass Success Messsage -->

            <table id="patientTable" class="table table-secondary table-striped table-bordered" style="width:100%; margin-top: 20px;; margin-bottom: 20px; size: 10px;">
            <div class="mb-2">
                <div class="col-md-12">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="<?php echo site_url('patient'); ?>"class="btn btn-success " style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Patient List</a>
                </div>
            </div>
            <thead>
                <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Sex</th>
                <th>Birth Date</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Deleted At</th>
                <th>Status</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient): ?>
                    <tr>
                        <td><?php echo $patient['id']; ?></td>
                        <td><?php echo $patient['firstname']; ?></td>
                        <td><?php echo $patient['middlename']; ?></td>
                        <td><?php echo $patient['lastname']; ?></td>
                        <td><?php echo $patient['sex']; ?></td>
                        <td><?php echo $patient['birthdate']; ?></td>
                        <td><?php echo $patient['email']; ?></td>
                        <td><?php echo $patient['phone']; ?></td>
                        <td><?php echo $patient['created_at']; ?></td>
                        <td><?php echo $patient['updated_at']; ?></td>
                        <td><?php echo $patient['deleted_at']; ?></td>
                        <td><?php echo $patient['status']; ?></td>
                        <td>
                            <a href="<?php echo site_url('patient/edit/'.$patient['id']); ?>">Edit</a> |
                            <a href="<?php echo site_url('patient/undo_soft_delete/'.$patient['id']); ?>" onclick="return confirm('Are you sure?');">Undo Discharge</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        </div>
    </div>

    <!-- Add jQuery, DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


    <script>
    $(document).ready(function() {
        $('#patientTable').DataTable();
    });
    </script>
</body>
</html>
