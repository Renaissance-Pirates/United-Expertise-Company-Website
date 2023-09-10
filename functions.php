<?php

function Add_CSS ()
{
	wp_register_style ('Fonts', get_template_directory_uri () . '/Styles/Fonts.css', false);
	wp_enqueue_style ('Fonts');
	wp_register_style ('Global', get_template_directory_uri () . '/Styles/Global.min.css', false);
	wp_enqueue_style ('Global');
	wp_register_style ('Index', get_template_directory_uri () . '/Styles/Index.min.css', false);
	wp_enqueue_style ('Index');
	wp_register_style ('Utility', get_template_directory_uri () . '/Styles/Utility.min.css', false);
	wp_enqueue_style ('Utility');
}

add_action ('wp_enqueue_scripts', 'Add_CSS');

function Add_JavaScript ()
{
	wp_register_script ('API', get_template_directory_uri () . '/Scripts/API.min.js', true);
	wp_enqueue_script ('API');
	wp_register_script ('Index', get_template_directory_uri () . '/Scripts/Index.min.js', true);
	wp_enqueue_script ('Index');
}

add_action ('wp_enqueue_scripts', 'Add_JavaScript');

function Add_Manifest_JSON () 
{   
	'<link rel="manifest" href="' . get_template_directory_uri () . '/manifest.json">';
}

add_action ('wp_head', 'Add_Manifest_JSON');

require_once (get_template_directory () . '/API/API.php');

function Configure_Email ($PHP_Mailer) 
{
	$PHP_Mailer -> isSMTP ();
	$PHP_Mailer -> Host = SMTP_Host;
	$PHP_Mailer -> Username = SMTP_Email;
	$PHP_Mailer -> Password = SMTP_Password;
	$PHP_Mailer -> Port = SMTP_Port;
	$PHP_Mailer -> SMTPAuth = SMTP_Authentication;
	$PHP_Mailer -> SMTPSecure = SMTP_Security_Layer;
  }

add_action ('phpmailer_init', 'Configure_Email');


?>