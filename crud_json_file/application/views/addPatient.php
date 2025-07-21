<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<meta name="description" content="create json file with crud operation">
<title>JSON Add Patient</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center;">Add Patient</h1>
        <form method="POST" id="patient_form" action="<?php echo base_url().'json/add';?>">
        <div class="row">
            <div class="col-md-3">
                <label>Name:</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
        </div>
        <div style="height: 10px;"></div>

        <div class="row">
            <div class="col-md-3">
                <label>Mobile:</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" name="mobile" id="mobile" maxlength="10" pattern="[1-9][0-9]{9}"  title="Enter 10 digit valid mobile number" required>
            </div>
        </div>
        <div style="height: 10px;"></div>

        <div class="row">
            <div class="col-md-3">
                <label>DOB:</label>
            </div>
            <div class="col-md-9">
                <input type="date" class="form-control" name="dob" id="dob" max="" required>
            </div>
        </div>
        <div style="height: 10px;"></div>

        <div class="row">
            <div class="col-md-3">
                <label>Gender:</label>
            </div>
            <div class="col-md-9">
                <input type="radio" name="gender" value="Male" required>Male
                <input type="radio" name="gender" value="Female" required>Female
            </div>
        </div>
        <div style="height: 10px;"></div>

        <div class="row">
            <div class="col-md-3">
                <label>Issue:</label>
            </div>
            <div class="col-md-9">
                <input type="checkbox" name="issue[]" value="fever">Fever
                <input type="checkbox" name="issue[]" value="cough">Cough
                <input type="checkbox" name="issue[]" value="heart">Heart
                <input type="checkbox" name="issue[]" value="kidney">Kidney
                <input type="checkbox" name="issue[]" value="liver">Liver
            </div>
        </div>
        <div style="height: 10px;"></div>

        <div class="row">
            <div class="col-md-3">
                <label>Entry Date:</label>
            </div>
            <div class="col-md-9">
                <input type="date" class="form-control" name="entry_date" id="entry_date" required>
            </div>
        </div>
        <div style="height: 10px;"></div>

        <button class="btn btn-primary" type="submit" value="Submit">Submit</button>
        <button class="btn btn-warning" type="reset" value="Reset">Reset</button>
        <button class="btn btn-secondary" id="home">Home</button>

    </div>

<script>

    var url = '<?php echo base_url();?>';

    const today = new Date().toISOString().split('T')[0];
    $('#dob').attr('max',today);

    $('#home').click(function(){
        window.location.href = url;
    });

    $('#patient_form').on('submit',function(e){
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