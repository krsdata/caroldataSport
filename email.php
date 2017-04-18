<?php $base_url = 'http://democarol.com/sportsswaps/';
$res = '23';
$reciverEmail = 'gurjarpkj@gmail.com';
$email_html = "hello";
$subject = 'subject';
							//$this->sendemail($senderEmail,$reciverEmail,$senderName,$ccEmails,$bccEmails,$subject,$message);
							$email = $reciverEmail;
							$subject = "Email verification from sports swap";
							$message = $email_html;
							$headers = 'MIME-Version: 1.0' . "\n";
							$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\n";
							$headers .= 'From: Sports Swaps<pankaj.caroldata@gmail.com>' . "\n";
							$jj = mail($email, $subject, $message, $headers);
							if($jj){
								echo 'yes';
							}else{
								echo 'no';
							} 
?>