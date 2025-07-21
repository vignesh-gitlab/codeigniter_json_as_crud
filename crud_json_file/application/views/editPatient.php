<?php 
if(!isset($currentPatient)){
    redirect(base_url());
}
?>
<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<meta name="description" content="create json file with crud operation">
<title>JSON Edit Patient</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center;">Edit Patient</h1>
        <form method="POST" id="patient_edit_form" action="<?php echo base_url().'json/editPatient';?>">
        <input type="hidden" name="patientIndex" value="<?= $patientIndex;?>">
        <div class="row">
            <div class="col-md-3">
                <label>Name:</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" name="name" id="name" value="<?php echo $currentPatient['name'];?>" required>
            </div>
        </div>
        <div style="height: 10px;"></div>

        <div class="row">
            <div class="col-md-3">
                <label>Mobile:</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" name="mobile" id="mobile" maxlength="10" value="<?php echo $currentPatient['mobile'];?>" pattern="[1-9][0-9]{9}"  title="Enter 10 digit valid mobile number" required>
            </div>
        </div>
        <div style="height: 10px;"></div>

        <div class="row">
            <div class="col-md-3">
                <label>DOB:</label>
            </div>
            <div class="col-md-9">
                <input type="date" class="form-control" name="dob" id="dob" value="<?php echo $currentPatient['dob'];?>" max="" required>
            </div>
        </div>
        <div style="height: 10px;"></div>

        <div class="row">
            <div class="col-md-3">
                <label>Gender:</label>
            </div>
            <div class="col-md-9">
                <input type="radio" name="gender" value="Male" <?= $currentPatient['gender'] == 'Male'?'checked':'' ?> required>Male
                <input type="radio" name="gender" value="Female" <?= $currentPatient['gender'] == 'Female'?'checked':''?> required>Female
            </div>
        </div>
        <div style="height: 10px;"></div>

        <div class="row">
            <div class="col-md-3">
                <label>Issue:</label>
            </div>
            <div class="col-md-9">
                <?php 
                $allIssues = ['fever','cough','heart','kidney','liver'];
                foreach($allIssues as $issue){
                    $checked = in_array($issue,$currentPatient['issue'])?'checked':'';
                    echo "<input type='checkbox' name='issue[]' value='$issue' $checked>$issue";
                }
                ?>
            </div>
        </div>
        <div style="height: 10px;"></div>

        <div class="row">
            <div class="col-md-3">
                <label>Entry Date:</label>
            </div>
            <div class="col-md-9">
                <input type="date" class="form-control" name="entry_date" id="entry_date" value="<?= $currentPatient['entry_date'];?>" required>
            </div>
        </div>
        <div style="height: 10px;"></div>

        <button class="btn btn-primary" type="submit" value="Submit">Edit</button>
        <button class="btn btn-warning" type="reset" value="Reset">Reset</button> 
        <button class="btn btn-secondary" type="button" id="home">Home</button>
</form>
    </div>

<script>

    var url = '<?php echo base_url();?>';

    const today = new Date().toISOString().split('T')[0];
    $('#dob').attr('max',today);

    $('#home').click(function(e){
        // e.preventDefault();
        window.location.href = url;
    });

    $('#patient_edit_form').on('submit',function(e){
        const check_boxes = $('input[name="issue[]"]:checked')
        if(check_boxes.length == 0){
            alert("Select atleast one issue");
            e.preventDefault();
            return;
        }
    });

</script>
</body>
</html>