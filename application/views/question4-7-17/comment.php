<?php
// Fetching Values From URL
$comment = $_POST['comment1'];
$question_id = $_POST['question_id1'];
$userid = $this->session->userdata('id');
$date_added = date('Y-m-d H:i:s');

if (isset($_POST['comment1'])) {
echo $query = mysqli_query("insert into ai_comment(user_id, question_id, comment, status,added_date) values ('$userid', '$question_id', '$comment','1','$date_added')"); exit;
if($query){
echo "Form Submitted succesfully"; exit;
}
}
mysql_close($connection); // Connection Closed
?>