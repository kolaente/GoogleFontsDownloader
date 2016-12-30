<?php

$fontfile = 'fonts.css'; //Your Googlefonts-CSS file

if(file_exists($fontfile))
{
	if (!file_exists('fonts_downloaded')) mkdir('fonts_downloaded');

	//Load Fontfile (to replace)
	$font_file = file_get_contents($fontfile);

	//Find all Fonturls
	$font_css = file($fontfile);
	foreach ($font_css as $css)
	{
		if (strpos($css, 'http') !== false)
		{
			$font_url = explode('(', $css);
			$font_url = str_replace(') format', '', $font_url[3]);
			$font_file_name = explode('/', $font_url);
			$font_file_name = end($font_file_name);
			if (copy($font_url, 'fonts_downloaded/' . $font_file_name))
			{
				echo '<b>' . $font_file_name . '</b> was downloaded successfully<br/>' . "\n";
				$font_file = str_replace($font_url, 'fonts_downloaded/' . $font_file_name, $font_file);
			} else
			{
				echo 'An error occured while downloading ' . $font_file_name . '<br/>' . "\n";
			}
		}
	}

	//Write new Fontfile
	if (file_put_contents($fontfile, $font_file))
	{
		echo 'Fontfile was changed successfully' . "\n";
	} else
	{
		echo 'An error occured while changing Fontfile' . "\n";
	}
}
else
{
	echo 'Fontfile not found.'."\n";
}