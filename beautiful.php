<?php
/**
 * @package Hello_quran
 * @version 20.21
 */
/*
Plugin Name: Hello Quran
Plugin URI: https://ismailsirajeittembe.com/plugins/hello-quran
Description: Assalam Alaikum to you all, on 29 March 2021 I forked HelloBeautiful, a one PHP file plugin by Michelle Frechette who works for https://impress.org the guy behind GiveWP WordPress Donation and WP Business Reviews Plugins. <br>She has a very nice post worth reading here https://impress.org/how-hello-dolly-helped-me-appreciate-developers-even-more/ which got me into this whole thing of creating my own WordPress Plugin. Since PHP doesn’t scare me <br>Like all Muslims around the world, we are constantly goingthrough a journey of self-discovery and personal improvement through theguidance of Allah's words.<br>This is not just a plugin, it's a comprehensive list of TheHoly Quran verses as quotes that teach us ways to improve our life.Guidance regarding every aspect of life. Remember Reading the Qur'an helps inrelieving stress and reducing anxiety and depression. <br>So, I hope this effort helps bring us closer to Allah andThe Holy Quran in the end Amen. When activated you will randomly see a quotefrom The Holy Quran, in the upper right of your admin screen on every page. <br>Read about me coding it on my bloghttps://ismailsirajeittembe.com/hello-quran-plugin/.
Author: Ismail Siraje Ittembe
Version: 20.21
Author URI: https://ismailsirajeittembe.com/
*/

function hello_quran_get_line() {
	/** These are the lines for Hello quran */
	$lines = "Hello, quran

	Call upon me, I will respond to you | Surah Ghafir 40:60
And Allah would not punish them while they seek forgiveness | Surah Al-Anfal 8:33
So remember me; I will remember you | Surah Al-Baqarah 2:152
And He has made me blessed wherever I am | Surah Maryam 19:31
He knows what is within the heavens and earth and knows what you conceal and what you declare. And Allah (SWT) is Knowing of that within the breasts | At-Taghabun 64:4
And whoever puts all his trust in Allah (SWT), He will be enough for him | Surah At-Talaq 65:1-3
Indeed, those who have believed and done righteous deeds will have gardens beneath which rivers flow that is a great attainment | Surah al-Buruj 85:11
If you are grateful, I will surely increase you [in favor] | Surah Ibrahim 14:7
Between them is a barrier which they do not transgress | Surah Al-Rahman
And He found you lost and guided [you] | Surah Ad-Duhaa 93:7
	
	";

	// Here we split it into lines.
	$lines = explode( "\n", $lines );

	// And then randomly choose a line.
	return wptexturize( $lines[ mt_rand( 0, count( $lines ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later.
function hello_quran() {
	$chosen = hello_quran_get_line();
	$lang   = '';
	if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
		$lang = ' lang="en"';
	}

	printf(
		'<p id="quran"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
		__( 'Daily affirmation:', 'hello-quran' ),
		$lang,
		$chosen
	);
}

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'admin_notices', 'hello_quran' );

// We need some CSS to position the paragraph.
function quran_css() {
	echo "
	<style type='text/css'>
	#quran {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 13px;
		line-height: 1.6666;
		color: #d328ae;
		font-weight: bold;
	}
	.rtl #quran {
		float: left;
	}
	.block-editor-page #quran {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#quran,
		.rtl #quran {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action( 'admin_head', 'quran_css' );
