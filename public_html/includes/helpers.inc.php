<?php
function html($text)
{
	return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function htmlout($text)
{
	$text = html($text);
	$text = str_replace("\n", '<br>', $text);
	echo $text;
}


