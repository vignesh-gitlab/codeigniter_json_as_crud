<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Json extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }
	
    public function index()
	{
		$this->load->view('show');
	}

    public function show(){
        $file = './uploads/sample.txt';
        if(file_exists($file)){
            $jsonData = file_get_contents($file);
            $patients = json_decode($jsonData,true);
            if(!is_array($patients)){
                $patients = [];
            }
        } else {
            $patients = [];
        }
        if($patients){
            $i=1;
            foreach($patients as $patient){
                ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= htmlspecialchars($patient['name']); ?></td>
                    <td><?= htmlspecialchars($patient['mobile']); ?></td>
                    <td><?= htmlspecialchars($patient['dob']); ?></td>
                    <td><?= htmlspecialchars($patient['gender']); ?></td>
                    <td><?= htmlspecialchars(implode(", ",$patient['issue'])); ?></td>
                    <td><?= htmlspecialchars($patient['entry_date']); ?></td>
                    <td>
                        <a href="<?php echo base_url().'json/edit/'.$patient['id'];?>"><button class="btn btn-warning">Edit</button></a>
                        <a href="<?php echo base_url().'json/delete/'.$patient['id'];?>" onclick="return confirm('Are you sure to Delete this id?')"><button class="btn btn-danger">Delete</button></a>
                    </td>
                </tr>
                <?php
                $i++;
            }

        } else {
            ?>
            <tr><td colspan="8" style="text-align: center;">No Data Found</td></tr>
            <?php 
        }
    }

    public function addPatient(){
        $this->load->view('addPatient');
    }

    public function add(){
        $file = './uploads/sample.txt';
        if(file_exists($file)){
            $jsonData = file_get_contents($file);
            $patients = json_decode($jsonData,true);
            if(!is_array($patients)){
                $patients = [];
            }
        } else {
            $patients = [];
        }

        $lastid = 0;
        foreach($patients as $patient)
        if(isset($patient['id']) && is_numeric($patient['id']) && $patient['id'] > $lastid){
            $lastid = $patient['id'];
        }
        $newid = $lastid + 1;

        $newPatient = [
            "id" => $newid,
            "name" => $_POST['name'] ?? '',
            "mobile" => $_POST['mobile'] ?? '',
            "dob" => $_POST['dob'] ?? '',
            "gender" => $_POST['gender'] ?? '',
            "issue" => $_POST['issue'] ?? '',
            "entry_date" => $_POST['entry_date'] ?? ''
        ];

        $patients[] = $newPatient;

        $added = file_put_contents($file,json_encode($patients,JSON_PRETTY_PRINT));
        if($added){
            // echo '<script>alert("Added Successfully!")</script>';
            echo '<script>
        alert("Added Successfully!");
        window.location.href = "' . base_url() . '";
    </script>';
    exit;
            // redirect(base_url());
        } else {
            echo '<script>alert("Failed!")</script>';
        }

    }

    public function edit($id = null){
        $id = (int)$id;
        if(!empty($id)){
            $file = './uploads/sample.txt';
            if(file_exists($file)){
                $jsonData = file_get_contents($file);
                $patients = json_decode($jsonData,true);
                if(!is_array($patients)){
                    die("File corrupted");
                }
            } else {
                die("File Not Exists");
            }

            $data = [];
            $found = false;
            foreach($patients as $index=>$patient){
                if($patient['id'] == $id){
                    $data['currentPatient'] = $patient;
                    $data['patientIndex'] = $id;
                    $found = true;
                    break;
                }
            }
            
            $this->load->view('editPatient',$data);
        }
    }

    public function editPatient(){
        $editIndex = (int)$_POST['patientIndex'];
        $file = './uploads/sample.txt';
        if(file_exists($file)){
            $jsonData = file_get_contents($file);
            $patients = json_decode($jsonData,true);
            if(!is_array($patients)){
                die("File Corrupted");
            }
        } else {
            die("File not exists");
        }

        // Find patient by ID
$found = false;
foreach ($patients as $index => $patient) {
    if ($patient['id'] == $editIndex) {
        $currentPatient = $patient;
        $patientIndex = $index;
        $found = true;
        break;
    }
}
if (!$found) {
    die("Patient with ID $editIndex not found.");
}
        
        $editPatient = [
            'id' => $editIndex,
            'name' => $_POST['name'],
            'mobile' => $_POST['mobile'],
            'dob' => $_POST['dob'],
            'gender' => $_POST['gender'],
            'issue' => $_POST['issue'],
            'entry_date' => $_POST['entry_date'],

        ];
        
        
        $patients[$patientIndex] = $editPatient;
        $edited = file_put_contents($file,json_encode($patients,JSON_PRETTY_PRINT));
        if($edited){
            echo '<script>alert("Edited Successfully");
            window.location.href="'.base_url().'"</script>';
        } else {
            echo '<script>alert("Failed")</script>';
        }
    }

    public function delete($id = null){
        $id = (int)$id;
        if(!is_numeric($id)){
            die("Invalid id");
        }
        $file = './uploads/sample.txt';
        if(file_exists($file)){
            $jsonData = file_get_contents($file);
            $patients = json_decode($jsonData,true);
            if(!is_array($patients)){
                die("Invalid file");
            }
        } else {
            die("File not exists");
        }

        $newData = array_filter($patients,function($patient) use ($id){
            return $patient['id'] != $id;
        });
        $newData = array_values($newData);
        $deleted = file_put_contents($file,json_encode($newData,JSON_PRETTY_PRINT));
        if($deleted){
            echo '<script>alert("Deleted Successfully");
            window.location.href="'.base_url().'"</script>';
        } else {
            echo '<script>alert("Failed to Delete");</script>';
        }
    }

}
