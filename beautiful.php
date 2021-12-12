<?php
/**
 * @package Hello_Beautiful
 * @version 1.2
 */
/*
Plugin Name: Hello Beautiful
Plugin URI: https://worksbymichelle.com/hello-beautiful
Description: This is not just a plugin, it tells you how amazing you are! <cite>Hello, Beautiful</cite> in the upper right of your admin screen on every page.
Author: Michelle Frechette
Version: 1.2
Author URI: https://worksbymichelle.com/
*/

function hello_beautiful_get_line() {
	/** These are the lines for Hello Beautiful */
	$lines = "Hello, Beautiful
You deserve another cup of coffee
Yes you can
Are you ready to create a masterpiece
What will you create today
Press publish because the world needs your voice
You should teach a class in this
I love how your mind works
You are doing great
You need a cookie
Take a deep breath and go for it
Peace and love
You look nice today
You got this
Share your words with the world because we want to read them
Write your truth then press publish
It's so nice to see you
You look amazing today
You're an amazing web designer
This site you built is gorgeous
Have I told you lately that I love you
Every time you log in, I smile
How have you been beautiful
There's a word for you, it's 'Splendiforous'
Please come back soon, my dear
You should win awards for the amazing work you do
The only thing better than this website is YOU
Other people build websites, you build works of art";

	// Here we split it into lines.
	$lines = explode( "\n", $lines );

	// And then randomly choose a line.
	return wptexturize( $lines[ mt_rand( 0, count( $lines ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later.
function hello_beautiful() {
	$chosen = hello_beautiful_get_line();
	$lang   = '';
	if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
		$lang = ' lang="en"';
	}

	printf(
		'<p id="beautiful"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
		__( 'Daily affirmation:', 'hello-beautiful' ),
		$lang,
		$chosen
	);
}

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'admin_notices', 'hello_beautiful' );

// We need some CSS to position the paragraph.
function beautiful_css() {
	echo "
	<style type='text/css'>
	#beautiful {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
		color: #20bc34;
		font-weight: bold;
	}
	.rtl #beautiful {
		float: left;
	}
	.block-editor-page #beautiful {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#beautiful,
		.rtl #beautiful {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action( 'admin_head', 'beautiful_css' );