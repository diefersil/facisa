<?php
/**
 * Funções do tema Facisa.
 */

// -----------------------------------------------------------------------------
// Configuração do tema
// -----------------------------------------------------------------------------

add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );

function facisa_enqueue_styles() {
	wp_enqueue_style( 'facisa-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'facisa_enqueue_styles' );

function facisa_setup() {
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary menu', 'facisa' ),
			'footer'  => esc_html__( 'Secondary menu', 'facisa' ),
		)
	);

	add_theme_support( 'post-thumbnails', array( 'post', 'cursos' ) );
}
add_action( 'after_setup_theme', 'facisa_setup' );

// -----------------------------------------------------------------------------
// Shortcodes
// -----------------------------------------------------------------------------

function facisa_shortcode_search_term() {
	return isset( $_GET['s'] ) ? sanitize_text_field( wp_unslash( $_GET['s'] ) ) : '';
}
add_shortcode( 'search_term', 'facisa_shortcode_search_term' );

function facisa_shortcode_title() {
	if ( is_singular( 'post' ) ) {
		return '<a href="' . esc_url( home_url( '/?page_id=1689' ) ) . '">Blog</a>';
	}

	if ( is_singular( 'cursos' ) ) {
		return '<a href="' . esc_url( home_url( '/?page_id=672' ) ) . '">Cursos</a>';
	}

	return get_the_title();
}
add_shortcode( 'title', 'facisa_shortcode_title' );

function facisa_shortcode_grad() {
	return 'graduacao';
}
add_shortcode( 'grad', 'facisa_shortcode_grad' );

// -----------------------------------------------------------------------------
// Scripts específicos das páginas de cursos
// -----------------------------------------------------------------------------

function facisa_hide_empty_course_tabs() {
	if ( ! is_singular( 'cursos' ) ) {
		return;
	}
	?>
	<script>
	document.querySelectorAll('.jet-tabs__control').forEach(function (control) {
		var contentId = control.id.replace('jet-tabs-control', 'jet-tabs-content');
		var content = document.getElementById(contentId);

		if (content && content.innerHTML.trim() === '') {
			control.style.display = 'none';
		}
	});
	</script>
	<?php
}
add_action( 'wp_footer', 'facisa_hide_empty_course_tabs' );

function facisa_course_form_script() {
	if ( ! is_singular( 'cursos' ) ) {
		return;
	}

	$utm_source   = isset( $_SESSION['utm_source'] ) ? sanitize_text_field( wp_unslash( $_SESSION['utm_source'] ) ) : '';
	$utm_campaign = isset( $_SESSION['utm_campaign'] ) ? sanitize_text_field( wp_unslash( $_SESSION['utm_campaign'] ) ) : '';
	$ref          = isset( $_SESSION['ref'] ) ? esc_url_raw( wp_unslash( $_SESSION['ref'] ) ) : '';
	?>
	<script>
	document.addEventListener('DOMContentLoaded', function () {
		var courseNameField = document.querySelector('#curso-nome .jet-listing-dynamic-field__content');
		var courseNameAlt = document.querySelector('#curso-nome2 .jet-listing-dynamic-field__content');
		var courseUrl = document.querySelector('#curso-url .jet-listing-dynamic-field__content');
		var courseName = courseNameField ? courseNameField.innerText.trim() : '';
		var setValue = function (id, value) {
			var field = document.getElementById(id);
			if (field) field.value = value;
		};

		if (courseNameAlt) setValue('input_1_25', courseNameAlt.innerText.trim());
		if (courseUrl) setValue('input_3_12', courseUrl.innerText.trim());
		if (courseNameField) setValue('input_3_14', courseName);
		setValue('input_3_15', <?php echo wp_json_encode( $utm_source ); ?>);
		setValue('input_3_16', <?php echo wp_json_encode( $utm_campaign ); ?>);
		setValue('input_3_17', <?php echo wp_json_encode( $ref ); ?>);

		var phoneField = document.getElementById('input_3_5');
		var contactField = document.getElementById('input_3_18');
		if (phoneField && contactField) {
			phoneField.addEventListener('change', function (event) {
				var phone = event.target.value.replace(/\D/g, '');
				var message = 'Sobre sua inscrição no curso: ' + courseName + ', da Facisa Unaí';
				contactField.value = 'https://api.whatsapp.com/send?phone=55' + phone + '&text=' + encodeURIComponent(message);
			});
		}
	});
	</script>
	<?php
}
add_action( 'wp_footer', 'facisa_course_form_script' );

// -----------------------------------------------------------------------------
// Formulário da página de vestibular (ID 4375)
// -----------------------------------------------------------------------------

function facisa_vestibular_form_script() {
	if ( ! is_page( 4375 ) ) {
		return;
	}
	?>
	<script>
	document.addEventListener('DOMContentLoaded', function () {
		var nameField = document.getElementById('input_1_1');
		var phoneField = document.getElementById('input_1_5');
		var courseSource = document.getElementById('curso-nome2');
		var courseField = document.getElementById('input_1_11');
		var form = document.getElementById('gform_1');
		var contactField = document.getElementById('input_1_12');
		var phoneLinkField = document.getElementById('input_1_13');

		if (!form || !nameField || !phoneField) return;
		if (courseField && courseSource) courseField.value = courseSource.innerText.trim();

		form.addEventListener('change', function () {
			var name = nameField.value;
			var phone = phoneField.value.replace(/\D/g, '');
			var course = courseField ? courseField.value : '';
			var message = 'Olá ' + name + '. Sobre sua inscrição no curso: ' + course + ', no site da Facisa Unaí';

			if (contactField) {
				contactField.value = 'https://api.whatsapp.com/send?phone=55' + phone + '&text=' + encodeURIComponent(message);
			}
			if (phoneLinkField) {
				phoneLinkField.value = 'https://facisaunai.edu.br/tel.php?tel=' + encodeURIComponent(phone);
			}
		});
	});
	</script>
	<?php
}
add_action( 'wp_footer', 'facisa_vestibular_form_script' );

// -----------------------------------------------------------------------------
// Google Analytics e Meta Pixel
// -----------------------------------------------------------------------------

function facisa_google_analytics() {
	?>
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-T3FL9CY7T5"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){window.dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', 'G-T3FL9CY7T5');
	</script>
	<?php
}
add_action( 'wp_head', 'facisa_google_analytics' );

function facisa_meta_pixel() {
	?>
	<!-- Meta Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
	n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)
	}(window, document,'script','https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '24140799618915748');
	fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	src="https://www.facebook.com/tr?id=24140799618915748&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Meta Pixel Code -->
	<?php
}
add_action( 'wp_head', 'facisa_meta_pixel' );
