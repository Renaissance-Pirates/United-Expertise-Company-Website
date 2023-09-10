<?php

add_action ('rest_api_init', function () 
{
	register_rest_route ('uec-theme/api', 'blogs', array ('methods'  => 'GET', 'callback' => 'Reload_Blogs'));
});

add_action ('rest_api_init', function () 
{
	register_rest_route ('uec-theme/api', 'email', array ('methods'  => 'POST', 'callback' => 'Send_Email'));
});

function Get_Hijri_Date ()
{
	// Source: https://redacacia.me/2010/08/16/coding-in-php-a-hijri-gregorian-calendar/

	$western_arabic = array ('0','1','2','3','4','5','6','7','8','9');
	$eastern_arabic = array ('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
	$Months = array ("ٱلْمُحَرَّم","صَفَر","رَبِيع ٱلْأَوَّل","رَبِيع ٱلْآخِر","جُمَادَىٰ ٱلْأُولَىٰ","جُمَادَىٰ ٱلْآخِرَة","رَجَب","شَعْبَان","رَمَضَان","شَوَّال","ذُو ٱلْقَعْدَة","ذُو ٱلْحِجَّة");
	$TDays = round (strtotime (get_the_date ('F j, Y')) / (60 * 60 * 24));
	$HYear = round ($TDays / 354.37419);
	$Remain = $TDays - ($HYear * 354.37419);
	$HMonths = round ($Remain / 29.531182);
	$HDays = $Remain - ($HMonths * 29.531182);
	$HYear = $HYear + 1389;
	$HMonths = $HMonths + 10;
	$HDays = $HDays + 23;
	if ($HDays > 29.531188 and round ($HDays) != 30)
	{
		$HMonths = $HMonths + 1;
		$HDays = Round ($HDays - 29.531182);
	}
	else
	{
		$HDays = Round ($HDays);
	}
	if($HMonths > 12)
	{
		$HMonths = $HMonths - 12;
		$HYear = $HYear + 1;
	}
	$HDays = str_replace ($western_arabic, $eastern_arabic, $HDays);
	$HYear = str_replace ($western_arabic, $eastern_arabic, $HYear);
	return $HDays . ' ' . $Months [$HMonths - 1] . ' ' . $HYear;
}

function Get_Blogs ($Language_Code)
{	
	$Query = new WP_Query (array ('post_type' => 'post'));
	if ($Query -> have_posts ()) 
	{
		$Post_Number = 1;
		while ($Query -> have_posts ())
		{
			$Query -> the_post ();
			$Language = array_map (fn ($Value): String => $Value -> name, get_the_category ()) [0];
			if ($Language_Code == 'en' && $Language == 'English')
			{
				echo '<a class="Blog_Card Cover_Background Text_Color_2" href="' . get_permalink () . '" rel="prev" data-bgimage="/Images/blog-card-' . $Post_Number . '.jpg" target="_blank">' .
					'<div class="Blog_Card_Overlay Background_Color_3">' .
						'<span></span>' .
						'<h3 class="Blog_Title Central_Text_Alignment Text_Color_2" id="Blog_Title_' . $Post_Number .'">' . get_the_title () . '</h3>' .
						'<span class="Blog_Date Text_Color_2" id="Blog_Date_' . $Post_Number .'">' . get_the_date ('F j, Y') .'</span>' .
					'</div>' .
					'<div class="Blog_Card_Hover_Overlay Background_Color_3 Padding_2rem">' .
						'<div class="Blog_Card_Hover_Overlay_Content Text_Color_2">' .
							'<h4>Click to read</h4>' .
							'<p>' . get_the_title () . '</p>' .
						'</div>' .
					'</div>' .
				'</a>';
				$Post_Number = $Post_Number + 1;
			}
			else if ($Language_Code == 'ar' && $Language == 'Arabic')
			{
				echo '<a class="Blog_Card Cover_Background Text_Color_2" href="' . get_permalink () . '" rel="prev" data-bgimage="/Images/blog-card-' . $Post_Number . '.jpg" target="_blank">' .
					'<div class="Blog_Card_Overlay Background_Color_3">' .
						'<span></span>' .
						'<h3 class="Blog_Title Central_Text_Alignment Text_Color_2 Arabic_Header" id="Blog_Title_' . $Post_Number .'">' . get_the_title () . '</h3>' .
						'<span class="Blog_Date_in_Arabic Text_Color_2 Arabic_Text" id="Blog_Date_' . $Post_Number .'">' . Get_Hijri_Date () .'</span>' .
					'</div>' .
					'<div class="Blog_Card_Hover_Overlay Background_Color_3 Padding_2rem">' .
						'<div class="Blog_Card_Hover_Overlay_Content Text_Color_2">' .
							'<h4 class="Arabic_Header">انقر للقراءة</h4>' .
							'<p class="Arabic_Text">' . get_the_title () . '</p>' .
						'</div>' .
					'</div>' .
				'</a>';
				$Post_Number = $Post_Number + 1;
			}
		}
	}
	else
	{
		echo '';
	}
	wp_reset_postdata ();
}

function Reload_Blogs ($Request) 
{
	$Language_Code = $Request -> get_param ('language');
	$Blogs_HTML = Get_Blogs ($Language_Code);
}

function Send_Email ($Request)
{
	$Request_Body = $Request -> get_json_params ();
	$Name = $Request_Body ['Name'];
	$Email = $Request_Body ['Email'];
	$Subject = $Request_Body ['Subject'];
	$Message = $Request_Body ['Message'];
	$Language = $Request_Body ['Language'];
	$To = 'info@uec-env.com.sa';
	$Headers = array ('Content-Type: text/html; charset=UTF-8', 'From: ' . $Name . ' <' . $Email . '>', 'Reply-To: ' . $Email);
	add_filter ('wp_mail_from', function ($Original_Email) use ($Email)
	{
		return $Email;
	});
	add_filter ('wp_mail_from_name', function ($Original_Name) use ($Name)
	{
		return $Name;
	});
	$Sending_Status = wp_mail ($To, $Subject, strip_tags ($Message), implode (PHP_EOL, $Headers));
	if ($Sending_Status)
	{
		return new WP_REST_Response (array ('Status' => 200, 'Message' => $Language == 'ar' ? 'لقد وصلتنا رسالتك! سيتصل بك مندوبنا خلال أيام عمل قليلة' : 'We got your message! Our representative will contact you in a few business days.'));
	}
	else 
	{
		return new WP_REST_Response (array ('Status' => 500, 'Message' => $Language == 'ar' ? 'حدث خطأ أثناء إرسال الرسالة' : 'There was an error sending the message'));
	}
}

?>