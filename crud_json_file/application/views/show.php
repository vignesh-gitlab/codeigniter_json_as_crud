<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width:device-width,initial-scale=1.0">
<meta name="description" content="create json file with crud operation">
<title>JSON List</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 style="text-align: center;">JSON List</h1>
                <button class="btn btn-primary" id="add">Add</button>
                <!-- <button class="btn btn-secondary" id="view">View</button> -->
                <table class="table table-striped table-bordered" style="margin-top: 20px;">
                    <thead>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Issue</th>
                        <th>Entry Date</th>
                        <th>Action</th>
                    </thead>
                    <tbody id="tbody">

                    </tbody>
                </table>
            </div>
        </div>

    </div>


<script>

    var url = '<?php echo base_url();?>';

    $(document).ready(function(){
        $.ajax({
            url: url+'json/show',
            method:'POST',
            success:function(response){
                $('#tbody').html(response);
            }
        });
    });

    $('#add').click(function(){
        window.location.href = url + 'json/addPatient';
    });


</script>
</body>
</html>
