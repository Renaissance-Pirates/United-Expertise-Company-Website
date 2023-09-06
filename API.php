<?php

function Reload_Blogs ($Request) 
{
    $Language = $Request -> get_param ('language');
    $Blogs_HTML = Get_Blogs ($Language);
	if ($Blogs_HTML != '') 
	{
		return new WP_Error ('No posts available', 'There are no blogs to display', array ('status' => 404));
	}
	return new WP_REST_Response ($Blogs_HTML, array ('status' => 200));
}

function Send_Email ()
{
	if (isset ($_POST))
	{
		$Name = $_POST ['Name'];
		$Email = $_POST ['Email'];
		$Subject = $_POST ['Subject'];
		$Message = $_POST ['Message'];
		$To = 'info@uec-env.com.sa';
		$Headers = 'From: '. $Email . '\r\n' . 'Reply-To: ' . $Email . '\r\n';
		$Sending_Status = wp_mail ($To, $Subject, strip_tags ($Message), $Headers);
		if ($Sending_Status)
		{
			echo json_encode (array ('Status' => 200, 'Message' => 'We got your message! Our representative will contact you in a few business days.'));
		}
		else 
		{
			echo json_encode (array ('Status' => 500, 'Message' => 'There was an error sending message'));
		}
	}
}

?>