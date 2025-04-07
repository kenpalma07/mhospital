<!DOCTYPE html>
<html>
<head>
    <title>Edit Patient</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>
<body>
    <div class="container">
        <div class="container mt-2" style="font-size: 10px;">
            <h5>Edit Patient</h5>

            <?php echo validation_errors(); ?>
            <?php echo form_open('patient/edit/' . $patient['id'], ['method' => 'post', 'enctype' => 'multipart/form-data']); ?>

            <div class="row">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <input class="form-control" type="file" id="profile_image" name="profile_image" accept="image/*">
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="<?php echo base_url($patient['profile_image']); ?>" width="200" alt="No Image" style="border: 1px solid #198754; border-radius: 10px;">
                    <input type="text" name="profile_image" value="<?php echo set_value('profile_image', $patient['profile_image']); ?>" style="">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label>First Name:</label>
                    <input type="text" name="firstname" value="<?php echo set_value('firstname', $patient['firstname']); ?>" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Middle Name:</label>
                    <input type="text" name="middlename" value="<?php echo set_value('middlename', $patient['middlename']); ?>" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Last Name:</label>
                    <input type="text" name="lastname" value="<?php echo set_value('lastname', $patient['lastname']); ?>" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>Sex:</label>
                    <select name="sex" class="form-select" required>
                        <option value="M" <?php echo set_value('sex', $patient['sex']) == 'M' ? 'selected' : ''; ?>>Male</option>
                        <option value="F" <?php echo set_value('sex', $patient['sex']) == 'F' ? 'selected' : ''; ?>>Female</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Birth Date:</label>
                    <input type="date" name="birthdate" value="<?php echo set_value('birthdate', $patient['birthdate']); ?>" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Email:</label>
                    <input type="text" name="email" value="<?php echo set_value('email', $patient['email']); ?>" class="form-control"><br>
                </div>
                <div class="col-md-6">
                    <label>Phone:</label>
                    <input type="text" name="phone" value="<?php echo set_value('phone', $patient['phone']); ?>" class="form-control"><br>
                </div>
            </div>
            <div class="row">
                <div class="btn-group col-md-5" role="group">
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="<?php echo site_url('patient/index'); ?>" class="btn btn-danger">Cancel</a>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</body>
</html>
