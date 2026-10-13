<?php

//session_start();

add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );

/*if(!isset($_SESSION['ref'])){
	$_SESSION['ref'] = $_SERVER['HTTP_REFERER'];
}*/

/*if(!isset($_SESSION['utm_source']) and isset($_GET['utm_source']) ){
	$_SESSION['utm_source'] = $_GET['utm_source'];
	$_SESSION['utm_campaign'] = $_GET['utm_campaign'];
}*/

/**/

function my_theme_enqueue_styles() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	//wp_enqueue_style('my-theme-extra-style', get_theme_file_uri('extra.css') );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
	
register_nav_menus(
	array(
		'primary' => esc_html__( 'Primary menu', 'twentytwentyone' ),
		'footer'  => esc_html__( 'Secondary menu', 'twentytwentyone' ),
	)
);
add_theme_support( 'post-thumbnails', array( 'post', 'cursos' ) );

/*add_filter('elementor/utils/get_the_archive_title','archive_callback'); 
function archive_callback( $title ) { 
	if ( is_search() ) { return 'Pesquisa por' . get_search_query() ; } return $title; 
}*/

function shortcode_search() { 
	return $_GET['s'];
}
add_shortcode('search_term', 'shortcode_search');


function shortcode_title() { 
	if ( is_singular('post')) {
		return "<a href='?page_id=1689'>Blog</a>";
	}
	if ( is_singular('cursos')) {
		return "<a href='?page_id=672'>Cursos</a>";
	}
	return get_the_title();
}
add_shortcode('title', 'shortcode_title');


/**/
function shortcode_grad() { 
	return 'graduacao';
}
add_shortcode('grad', 'shortcode_grad');


/*function archive_to_custom_archive() {
    if( is_post_type_archive( 'cursos' ) ) {
        header("Location: https://facisaunai.edu.br/2024/cursos/",TRUE,301);
    }
}
add_action( 'template_redirect', 'archive_to_custom_archive' );*/

/*add_action('init', function () {
	add_rewrite_rule('cursos/?$','index.php?pagename=cursos', 'top');
	flush_rewrite_rules();
}, 1000);*/

add_action ('wp_footer','hideEmptyTabs');
function hideEmptyTabs() {
    if ( is_singular('cursos') ) {?>
		<script type="text/javascript">
			Array.from(document.querySelectorAll('.jet-tabs__control')).forEach((v)=>{
				let content  = v.id.replace('jet-tabs-control','jet-tabs-content')
				if( document.getElementById(content).innerHTML==='' ){
						v.style.display='none'
				}
			})
		</script> 
		 
   <?php }
}

add_action ('wp_footer','curso_url');
function curso_url() {
    if ( is_singular('cursos') ) {?>
		<script type="text/javascript">
			if(document.getElementById('input_1_25')) { document.getElementById('input_1_25').value = document.querySelector('#curso-nome2 .jet-listing-dynamic-field__content').innerText  }
			document.getElementById('input_3_12').value = document.querySelector('#curso-url .jet-listing-dynamic-field__content').innerText
			document.getElementById('input_3_14').value = document.querySelector('#curso-nome .jet-listing-dynamic-field__content').innerText
			//document.getElementById('input_1_25').value = document.querySelector('#curso-nome2 .jet-listing-dynamic-field__content').innerText   
			document.getElementById('input_3_15').value = '<?php echo $_SESSION['utm_source']; ?>'
			document.getElementById('input_3_16').value = '<?php echo $_SESSION['utm_campaign']; ?>'
			document.getElementById('input_3_17').value = '<?php echo $_SESSION['ref']; ?>'
			let curso_nome = document.querySelector('#curso-nome .jet-listing-dynamic-field__content').innerText

			//let utm_source = document.getElementById('input_1_15') 
			//utm_source.value = '<?php echo 'instagram' //$_GET['utm_source'];?>'
			//let utm_campaign = document.getElementById('input_1_16') 
			//utm_campaign.value = '<?php echo '25656' //$_GET['utm_campaign'];?>'

			/*Link Falar com aluno*/
			get_zap = document.getElementById('input_3_5')
			let falar_aluno = document.getElementById('input_3_18')
			get_zap.addEventListener('change', (e) =>{
				falar_aluno.value = 
				encodeURI(`https://api.whatsapp.com/send?phone=+55${e.target.value}&text=Sobre sua inscrição no curso: ${curso_nome}, da Facisa Unaí`)
			})
		</script>
		 
   <?php }
}

/*Link Falar com aluno*/
add_action ('wp_footer','vestibular');
function vestibular() {
    global $post;
    if( $post->ID == 4375){?>
		<script type="text/javascript">
			let nome = document.getElementById('input_1_1')
			nome.addEventListener('change', e => nome.value = e.target.value )  		
			let zap = document.getElementById('input_1_5')
			zap.addEventListener('change', e => zap.value = e.target.value )  
			//let curso = document.getElementById('input_1_11')
			//curso.addEventListener('change', e => curso.value = e.target.value ) 
			document.getElementById('input_1_11').value = document.getElementById('curso-nome2').innerText
			let form = document.getElementById('gform_1')
			let falar_aluno = document.getElementById('input_1_12') 
			let falar_aluno_fone = document.getElementById('input_1_13') 
			form.addEventListener('change', e => {
				falar_aluno.value = encodeURI(`https://api.whatsapp.com/send?phone=+55${zap.value}&text=Olá ${nome.value}. Sobre sua inscrição no curso: ${curso.value}, no site da Facisa Unaí`)
				//falar_aluno_fone.value = `<a href='${encodeURI(`tel:${zap.value}`)}'>Ligar para ${zap.value}</a>`
				falar_aluno_fone.value = encodeURI(`http://facisaunai.edu.br/tel.php?tel=${zap.value}`)
			})  
		</script> 
   <?php }
}

add_action ('wp_head','ga');
function ga() {?>
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-T3FL9CY7T5"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'G-T3FL9CY7T5');
	</script>
<?php }

/*---------------Add new Meta Title-----------------------------------*/

/*add_filter('wpseo_metadesc','custom_meta');
function custom_meta( $desc ){

    if () {
        $desc = "Change the description";
    } 

    return $desc;
}
add_filter('wpseo_title','custom_title');
function custom_title( $title ){


    if () {
        $title = "Change the title";
    }   
    return $title;
}*/


/**/
/*function shortcode_utm_source() { 
	return $_GET['utm_source'];
}
add_shortcode('utm_source', 'shortcode_utm_source');

function shortcode_utm_campaign() { 
	return $_GET['utm_campaign'];
}
add_shortcode('utm_campaign', 'shortcode_utm_campaign');*/


/*function track_utm(){?>
	<script type="text/javascript" src="https://d1b3llzbo1rqxo.cloudfront.net/attributer.js"></script>
<?php }
add_action('wp_footer','track_utm');*/


add_action ('wp_head','pixel_meta');
function pixel_meta() {?>
	<!-- Meta Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window, document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '24140799618915748');
	fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	src="https://www.facebook.com/tr?id=24140799618915748&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Meta Pixel Code -->
<?php }






