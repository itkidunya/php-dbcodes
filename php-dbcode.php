
<!----------Database connection OOP------------>
<?php
	$servername = "localhost";
	$username = "username";
	$password = "password";
	$database = "dbname";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $database);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
		echo "Connected successfully";
?>

<!----------Database connection Core------------>
<?php
	$servername = "localhost";
	$username = "username";
	$password = "password";
	$database = "dbname";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $database);

	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	echo "Connected successfully";
?>

<!----------Database connection Codeigniter------------>
<?php
$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root';
$db['default']['password'] = '';
$db['default']['database'] = 'dbname';
$db['default']['dbdriver'] = 'mysql';
?>

<!----------Database Creation OOP------------>
<?php
	$sql = "CREATE DATABASE dbname";
	if ($conn->query($sql) === TRUE) {
		echo "Database created successfully";
	} else {
		echo "Error creating database: " . $conn->error;
	}
?>

<!----------Database Creation Core------------>
<?php
	$sql = "CREATE DATABASE dbname";
	if (mysqli_query($conn, $sql)) {
		echo "Database created successfully";
	} else {
		echo "Error creating database: " . mysqli_error($conn);
	}
?>

<!----------Database Table Creation OOP------------>
<?php
	$sql = "CREATE TABLE tblname (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	firstname VARCHAR(30) NOT NULL,
	lastname VARCHAR(30) NOT NULL,
	email VARCHAR(50),
	reg_date TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
		echo "Table tblname created successfully";
	} else {
		echo "Error creating table: " . $conn->error;
	}
?>

<!----------Database Table Creation Core------------>
<?php
	$sql = "CREATE TABLE tblname (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	firstname VARCHAR(30) NOT NULL,
	lastname VARCHAR(30) NOT NULL,
	email VARCHAR(50),
	reg_date TIMESTAMP
	)";

	if (mysqli_query($conn, $sql)) {
		echo "Table tblname created successfully";
	} else {
		echo "Error creating table: " . mysqli_error($conn);
	}
?>

<!----------Database Insert Record OOP------------>
<?php
	$sql = "INSERT INTO tblname (firstname, lastname, email)
	VALUES ('Example', 'Name', 'name@example.com')";

	if ($conn->query($sql) === TRUE) {
		echo "New record inserted successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
?>

<!----------Database Insert Record Core------------>
<?php
	$sql = "INSERT INTO tblname (firstname, lastname, email)
	VALUES ('Example', 'Name', 'name@example.com')";

	if (mysqli_query($conn, $sql)) {
		echo "New record Inserted successfully";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
?>

<!----------Database Insert Record Codeigniter------------>
<?php
	/*********Insert.php**********/
	
	$data = array(
	'Name' => $this->input->post('name'),
	'Email' => $this->input->post('email'),
	'Mobile' => $this->input->post('mobile'),
	'Address' => $this->input->post('address')
	);
	//Transfering data to Model
	$this->insert_model->insert_record($data);
	$data['message'] = 'Data Inserted Successfully';
	//Loading View
	$this->load->view('insert_view', $data);
	
	/********Insert_model.php*********/
	
	class insert_model extends CI_Model{
	function __construct() {
	parent::__construct();
	}
	function insert_record($data){
	// Inserting in Table of Database
	$this->db->insert('tblname', $data);
	}
	}
?>

<!----------Database View Record Core------------>
<?php
	$sql = "SELECT id, firstname, lastname FROM tblname";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
		}
	} else {
		echo "No record found";
	}
?>

<!----------Database View Record OOP------------>
<?php
	$sql = "SELECT id, firstname, lastname FROM tblname";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		echo "<table><tr><th>ID</th><th>Name</th></tr>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>".$row["id"]."</td><td>".$row["firstname"]." ".$row["lastname"]."</td></tr>";
		}
		echo "</table>";
	} else {
		echo "No record found";
	}
?>

<!----------Database View Record Codeigniter------------>
<?php
	/*********model.php**********/
	
	function show_record()
    {
        $q = $this->db->get('printer');
        foreach ($q->result() as $row)
            {
                $data = array();
                $data['id'] = $row->id;
                $data['name'] = $row->name; 
            }   
        return $data;
    }
?>
	
<?php
	/*********controller.php**********/
	function catalog()
{
    $this->load->model('model');
    $data = $this->model->Show_record();
    $this->load->view('catalog', $data);
}
?>
	
<?php
	/*********view.php**********/
	foreach($result as $row){
	?>
	<tr>
	<td><?php echo $row->title;?></td>
	<td><?php echo $row->name; ?></td>
	</tr>
	<?php
	}
?>

<?php
	/*********Database delete record OOP**********/
	$sql = "DELETE FROM tblname WHERE id=3";
	if ($conn->query($sql) === TRUE) {
		echo "Record deleted successfully";
	} else {
		echo "Error deleting record: " . $conn->error;
	}
?>


<?php
	///////////// Database delete record Core////////////////
	$sql = "DELETE FROM tblname WHERE id=3";
	if (mysqli_query($conn, $sql)) {
		echo "Record deleted successfully";
	} else {
		echo "Error deleting record: " . mysqli_error($conn);
	}
?>
<?php
///////////Database Delete Record Codeigniter//////////////

	/*********model.php**********/
	
	function row_delete()
	{
	   $this->db->where('id', $id);
	   $this->db->delete('testimonials'); 
	}
?>
<?php	
	/********Controller.php*********/
	
	function delete_row()
	{
	   $this->load->model('mod1');
	   $this->mod1->row_delete();
	   redirect($_SERVER['HTTP_REFERER']);  
	}
?>

	/********View.php*********/
	
	 <?php foreach($query as $row){ ?>
	 <tr>
	 <td><?php echo $row->name  ?></td>
	  <td><?php echo $row->testi  ?></td>
	  <td><?php echo anchor('textarea/delete_row', 'DELETE', 'id="$row->id"'); ?></td>
	  <td><a href="#ajax-modal2" data-id="delete[]" role="button" class="Delete" data-toggle="modal" onClick="confirm_delete()"><i class="icon-trash"></i></a></td>
	  </tr>

	<?php } ?>
	
	

<?php
	///////////// Database Update record OOP////////////////

	$sql = "UPDATE tblname SET fname='firstname', lname='lasttname' WHERE id=2";

	if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $conn->error;
	}
?>

<?php
	
///////////// Database Update record Core////////////////
	$sql = "UPDATE tblname SET fname='firstname', lname='lasttname' WHERE id=2";
	if (mysqli_query($conn, $sql)) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . mysqli_error($conn);
	}
?>



	<?php

	///////////Database Update Record Codeigniter//////////////

	/*********model.php**********/
	
	class update_model extends CI_Model{
	// Function To Fetch All Students Record
	function show_students(){
	$query = $this->db->get('students');
	$query_result = $query->result();
	return $query_result;
	}
	// Function To Fetch Selected Student Record
	function show_student_id($data){
	$this->db->select('*');
	$this->db->from('students');
	$this->db->where('student_id', $data);
	$query = $this->db->get();
	$result = $query->result();
	return $result;
	}
	// Update Query For Selected Student
	function update_student_id1($id,$data){
	$this->db->where('student_id', $id);
	$this->db->update('students', $data);
	}
	}
	?>
	
	
	
	<?php
	/********Controller.php*********/
	class update_ctrl extends CI_Controller{
	function __construct(){
	parent::__construct();
	$this->load->model('update_model');
	}
	function show_student_id() {
	$id = $this->uri->segment(3);
	$data['students'] = $this->update_model->show_students();
	$data['single_student'] = $this->update_model->show_student_id($id);
	$this->load->view('update_view', $data);
	}
	function update_student_id1() {
	$id= $this->input->post('did');
	$data = array(
	'Student_Name' => $this->input->post('dname'),
	'Student_Email' => $this->input->post('demail'),
	'Student_Mobile' => $this->input->post('dmobile'),
	'Student_Address' => $this->input->post('daddress')
	);
	$this->update_model->update_student_id1($id,$data);
	$this->show_student_id();
	}
	}
	?>

	/********View.php*********/

	<div id="menu">
	/////////////Fetching Names Of All Students From Database//////////////
	<ol>
	<?php foreach ($students as $student): ?>
	<li><a href="<?php echo base_url() . "index.php/update_ctrl/show_student_id/" . $student->student_id; ?>"><?php echo $student->student_name; ?></a></li>
	<?php endforeach; ?>
	</ol>
	</div>
	<div id="detail">
	//////////////Fetching All Details of Selected Student From Database And Showing In a Form//////////////
	<?php foreach ($single_student as $student): ?>
	<p>Edit Detail & Click Update Button</p>
	<form method="post" action="<?php echo base_url() . "index.php/update_ctrl/update_student_id1"?>">
	<label id="hide">Id :</label>
	<input type="text" id="hide" name="did" value="<?php echo $student->student_id; ?>">
	<label>Name :</label>
	<input type="text" name="dname" value="<?php echo $student->student_name; ?>">
	<label>Email :</label>
	<input type="text" name="demail" value="<?php echo $student->student_email; ?>">
	<label>Mobile :</label>
	<input type="text" name="dmobile" value="<?php echo $student->student_mobile; ?>">
	<label>Address :</label>
	<input type="text" name="daddress" value="<?php echo $student->student_address; ?>">
	<input type="submit" id="submit" name="dsubmit" value="Update">
	</form>
	<?php endforeach; ?>
	</div>
	
	