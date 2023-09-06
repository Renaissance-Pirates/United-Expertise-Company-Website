<?php

function Add_CSS ()
{
	wp_register_style ('Fonts', get_template_directory_uri () . '/styles/Fonts.css', false);
	wp_enqueue_style ('Fonts');
	wp_register_style ('Global', get_template_directory_uri () . '/styles/Global.min.css', false);
	wp_enqueue_style ('Global');
	wp_register_style ('Index', get_template_directory_uri () . '/styles/Index.min.css', false);
	wp_enqueue_style ('Index');
	wp_register_style ('Utility', get_template_directory_uri () . '/styles/Utility.min.css', false);
	wp_enqueue_style ('Utility');
}

add_action ('wp_enqueue_scripts', 'Add_CSS');

function Add_JavaScript ()
{
	wp_register_script ('Index', get_template_directory_uri () . '/Index.min.js', true);
	wp_enqueue_script ('Index');
}

add_action ('wp_enqueue_scripts', 'Add_JavaScript');

function Add_Manifest_JSON () 
{   
	echo '<link rel="manifest" href="' . get_template_directory_uri () . '/manifest.json">';
}

add_action ('wp_head', 'Add_Manifest_JSON');

function Get_Hijri_Date ()
{
	// Source: https://redacacia.me/2010/08/16/coding-in-php-a-hijri-gregorian-calendar/

	$western_arabic = array('0','1','2','3','4','5','6','7','8','9');
	$eastern_arabic = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
	$Months = array ("ٱلْمُحَرَّم","صَفَر","رَبِيع ٱلْأَوَّل","رَبِيع ٱلْآخِر","جُمَادَىٰ ٱلْأُولَىٰ","جُمَادَىٰ ٱلْآخِرَة","رَجَب","شَعْبَان","رَمَضَان","شَوَّال","ذُو ٱلْقَعْدَة","ذُو ٱلْحِجَّة");
	$TDays=round(strtotime(get_the_date ('F j, Y'))/(60*60*24));
	$HYear=round($TDays/354.37419);
	$Remain=$TDays-($HYear*354.37419);
	$HMonths=round($Remain/29.531182);
	$HDays=$Remain-($HMonths*29.531182);
	$HYear=$HYear+1389;
	$HMonths=$HMonths+10;
	$HDays=$HDays+23;
	if ($HDays>29.531188 and round($HDays)!=30)
	{
		$HMonths=$HMonths+1;
		$HDays=Round($HDays-29.531182);
	}
	else
	{
		$HDays=Round($HDays);
	}
	if($HMonths>12)
	{
		$HMonths=$HMonths-12;
		$HYear=$HYear+1;
	}
	$HDays = str_replace($western_arabic, $eastern_arabic, $HDays);
	$HYear = str_replace($western_arabic, $eastern_arabic, $HYear);
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
				echo '<a class="Blog_Card Cover_Background Text_Color_2" href="' . get_permalink () . '" rel="prev" data-bgimage="/assets/images/blog-card-' . $Post_Number . '.jpg" target="_blank">';
					echo '<div class="Blog_Card_Overlay Background_Color_3">';
						echo '<span></span>';
						echo '<h3 class="Blog_Title Central_Text_Alignment Text_Color_2" id="Blog_Title_' . $Post_Number .'">' . get_the_title () . '</h3>';
						echo '<span class="Blog_Date Text_Color_2" id="Blog_Date_' . $Post_Number .'">' . get_the_date ('F j, Y') .'</span>';
					echo '</div>';
					echo '<div class="Blog_Card_Hover_Overlay Background_Color_3 Padding_2rem">';
						echo '<div class="Blog_Card_Hover_Overlay_Content Text_Color_2">';
							echo '<h4>Click to read</h4>';
							echo '<p>' . get_the_title () . '</p>';
						echo '</div>';
					echo '</div>';
				echo '</a>';
				$Post_Number = $Post_Number + 1;
			}
			else if ($Language_Code == 'ar' && $Language == 'Arabic')
			{
				echo '<a class="Blog_Card Cover_Background Text_Color_2" href="' . get_permalink () . '" rel="prev" data-bgimage="/assets/images/blog-card-' . $Post_Number . '.jpg" target="_blank">';
					echo '<div class="Blog_Card_Overlay Background_Color_3">';
						echo '<span></span>';
						echo '<h3 class="Blog_Title Central_Text_Alignment Text_Color_2 Arabic_Header" id="Blog_Title_' . $Post_Number .'">' . get_the_title () . '</h3>';
						echo '<span class="Blog_Date_in_Arabic Text_Color_2 Arabic_Text" id="Blog_Date_' . $Post_Number .'">' . Get_Hijri_Date () .'</span>';
					echo '</div>';
					echo '<div class="Blog_Card_Hover_Overlay Background_Color_3 Padding_2rem">';
						echo '<div class="Blog_Card_Hover_Overlay_Content Text_Color_2">';
							echo '<h4 class="Arabic_Header">انقر للقراءة</h4>';
							echo '<p class="Arabic_Text">' . get_the_title () . '</p>';
						echo '</div>';
					echo '</div>';
				echo '</a>';
				$Post_Number = $Post_Number + 1;
			}
			else
			{
				echo '';
			}
        }
    }
    wp_reset_postdata ();
}

add_action ('rest_api_init', function () 
{
	register_rest_route ('uec-theme/api', 'blogs', array ('methods'  => 'GET', 'callback' => 'Reload_Blogs'));
});
add_action ('wp_ajax_Send_Email', 'Send_Email');
add_action ('wp_ajax_nopriv_Send_Email', 'Send_Email');

require_once (get_template_directory () . '/API.php');


?>