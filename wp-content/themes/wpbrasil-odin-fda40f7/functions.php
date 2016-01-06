<?php
/**
 * Odin functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package Odin
 * @since 2.2.0
 */

/**
 * Sets content width.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 600;
}

/**
 * Odin Classes.
 */
require_once get_template_directory() . '/core/classes/class-bootstrap-nav.php';
require_once get_template_directory() . '/core/classes/class-shortcodes.php';
require_once get_template_directory() . '/core/classes/class-thumbnail-resizer.php';
// require_once get_template_directory() . '/core/classes/class-theme-options.php';
// require_once get_template_directory() . '/core/classes/class-options-helper.php';
// require_once get_template_directory() . '/core/classes/class-post-type.php';
// require_once get_template_directory() . '/core/classes/class-taxonomy.php';
// require_once get_template_directory() . '/core/classes/class-metabox.php';
// require_once get_template_directory() . '/core/classes/abstracts/abstract-front-end-form.php';
// require_once get_template_directory() . '/core/classes/class-contact-form.php';
// require_once get_template_directory() . '/core/classes/class-post-form.php';
// require_once get_template_directory() . '/core/classes/class-user-meta.php';
// require_once get_template_directory() . '/core/classes/class-post-status.php';
// require_once get_template_directory() . '/core/classes/class-term-meta.php';

/**
 * Odin Widgets.
 */
require_once get_template_directory() . '/core/classes/widgets/class-widget-like-box.php';

if ( ! function_exists( 'odin_setup_features' ) ) {

	/**
	 * Setup theme features.
	 *
	 * @since 2.2.0
	 */
	function odin_setup_features() {

		/**
		 * Add support for multiple languages.
		 */
		load_theme_textdomain( 'odin', get_template_directory() . '/languages' );

		/**
		 * Register nav menus.
		 */
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu', 'odin' )
			)
		);

		/*
		 * Add post_thumbnails suport.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add feed link.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Support Custom Header.
		 */
		$default = array(
			'width'         => 0,
			'height'        => 0,
			'flex-height'   => false,
			'flex-width'    => false,
			'header-text'   => false,
			'default-image' => '',
			'uploads'       => true,
		);

		add_theme_support( 'custom-header', $default );

		/**
		 * Support Custom Background.
		 */
		$defaults = array(
			'default-color' => '',
			'default-image' => '',
		);

		add_theme_support( 'custom-background', $defaults );

		/**
		 * Support Custom Editor Style.
		 */
		add_editor_style( 'assets/css/editor-style.css' );

		/**
		 * Add support for infinite scroll.
		 */
		add_theme_support(
			'infinite-scroll',
			array(
				'type'           => 'scroll',
				'footer_widgets' => false,
				'container'      => 'content',
				'wrapper'        => false,
				'render'         => false,
				'posts_per_page' => get_option( 'posts_per_page' )
			)
		);

		/**
		 * Add support for Post Formats.
		 */
		// add_theme_support( 'post-formats', array(
		//     'aside',
		//     'gallery',
		//     'link',
		//     'image',
		//     'quote',
		//     'status',
		//     'video',
		//     'audio',
		//     'chat'
		// ) );

		/**
		 * Support The Excerpt on pages.
		 */
		// add_post_type_support( 'page', 'excerpt' );

		/**
		 * Switch default core markup for search form, comment form, and comments to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption'
			)
		);

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
	}
}

add_action( 'after_setup_theme', 'odin_setup_features' );

/**
 * Register widget areas.
 *
 * @since 2.2.0
 */
function odin_widgets_init() {
	register_sidebar(
		array(
			'name' => __( 'Main Sidebar', 'odin' ),
			'id' => 'main-sidebar',
			'description' => __( 'Site Main Sidebar', 'odin' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widgettitle widget-title">',
			'after_title' => '</h3>',
		)
	);
}

add_action( 'widgets_init', 'odin_widgets_init' );

/**
 * Flush Rewrite Rules for new CPTs and Taxonomies.
 *
 * @since 2.2.0
 */
function odin_flush_rewrite() {
	flush_rewrite_rules();
}

add_action( 'after_switch_theme', 'odin_flush_rewrite' );

/**
 * Load site scripts.
 *
 * @since 2.2.0
 */
function odin_enqueue_scripts() {
	$template_url = get_template_directory_uri();

	// Loads Odin main stylesheet.
	wp_enqueue_style( 'odin-style', get_stylesheet_uri(), array(), null, 'all' );

	// jQuery.
	wp_enqueue_script( 'jquery' );

	// General scripts.
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		// Bootstrap.
		wp_enqueue_script( 'bootstrap', $template_url . '/assets/js/libs/bootstrap.min.js', array(), null, true );

		// FitVids.
		wp_enqueue_script( 'fitvids', $template_url . '/assets/js/libs/jquery.fitvids.js', array(), null, true );

		// Main jQuery.
		wp_enqueue_script( 'odin-main', $template_url . '/assets/js/main.js', array(), null, true );
	} else {
		// Grunt main file with Bootstrap, FitVids and others libs.
		wp_enqueue_script( 'odin-main-min', $template_url . '/assets/js/main.min.js', array(), null, true );
	}

	// Grunt watch livereload in the browser.
	// wp_enqueue_script( 'odin-livereload', 'http://localhost:35729/livereload.js?snipver=1', array(), null, true );

	// Load Thread comments WordPress script.
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'odin_enqueue_scripts', 1 );

/**
 * Odin custom stylesheet URI.
 *
 * @since  2.2.0
 *
 * @param  string $uri Default URI.
 * @param  string $dir Stylesheet directory URI.
 *
 * @return string      New URI.
 */
function odin_stylesheet_uri( $uri, $dir ) {
	return $dir . '/assets/css/style.css';
}

add_filter( 'stylesheet_uri', 'odin_stylesheet_uri', 10, 2 );

/**
 * Query WooCommerce activation
 *
 * @since  2.2.6
 *
 * @return boolean
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}

/**
 * Core Helpers.
 */
require_once get_template_directory() . '/core/helpers.php';

/**
 * WP Custom Admin.
 */
require_once get_template_directory() . '/inc/admin.php';

/**
 * Comments loop.
 */
require_once get_template_directory() . '/inc/comments-loop.php';

/**
 * WP optimize functions.
 */
require_once get_template_directory() . '/inc/optimize.php';

/**
 * Custom template tags.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * WooCommerce compatibility files.
 */
if ( is_woocommerce_activated() ) {
	add_theme_support( 'woocommerce' );
	require get_template_directory() . '/inc/woocommerce/hooks.php';
	require get_template_directory() . '/inc/woocommerce/functions.php';
	require get_template_directory() . '/inc/woocommerce/template-tags.php';
}




/*=================PEDIDOS=================*/

add_action('init', 'type_post_pedidos');
 
function type_post_pedidos() { 
	$labels = array(
		'name' => _x('Pedidos', 'post type general name'),
		'singular_name' => _x('Pedido', 'post type singular name'),
		'add_new' => _x('Adicionar Novo', 'Novo item'),
		'add_new_item' => __('Novo Item'),
		'edit_item' => __('Editar Item'),
		'new_item' => __('Novo Item'),
		'view_item' => __('Ver Item'),
		'search_items' => __('Procurar Itens'),
		'not_found' =>  __('Nenhum registro encontrado'),
		'not_found_in_trash' => __('Nenhum registro encontrado na lixeira'),
		'parent_item_colon' => '',
		'menu_name' => 'Pedidos');
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'public_queryable' => true,
		'show_ui' => true,			
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => null,
		'register_meta_box_cb' => 'pedidos_meta_box',		
		'supports' => array('title','editor'));
 
	register_post_type( 'pedidos' , $args );
	flush_rewrite_rules();
	}

	
register_taxonomy(
	"categoriaspedidos", 
    "produtos", 
      array(            
      	"label" => "Categorias", 
            "singular_label" => "Categoria", 
            "rewrite" => true,
            "hierarchical" => true)
	);

function pedidos_meta_box(){        
    add_meta_box('campos_pedidos', __('Informações'), 'campos_pedidos', 'pedidos', 'side', 'high');
}

function campos_pedidos(){
	global $post;
    $campoCliente = get_post_meta($post->ID, 'campo_pedido_cliente', true); 
	$campoProduto = get_post_meta($post->ID, 'campo_pedido_produto', true); 
	$campoQtde = get_post_meta($post->ID, 'campo_quantidade', true); 
	?>        
		<br>
		<label for="inputValorPedidoCliente">Cliente: </label>
		<select name="campo_pedido_cliente" id="inputValorPedidoCliente">
			<option value="<?php echo $campoCliente; ?>"><?php echo $campoCliente; ?></option>

			<?php 
			$newsArgs = array( 'post_type' => 'clientes' );                   					
			$newsLoop = new WP_Query( $newsArgs );                  					
			while ( $newsLoop->have_posts() ) : $newsLoop->the_post();              ?>
		
				<option value="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></option>
	
			<?php endwhile; ?>
			
		</select>
		<br>
		<br>
		<label for="inputValorPedidoProduto">Produto: </label>
		<select  name="campo_pedido_produto" id="inputValorPedidoProduto">
			<option value="<?php echo $campoProduto; ?>"><?php echo $campoProduto; ?></option>

			<?php 
			$newsArgs = array( 'post_type' => 'produtos' );                   					
			$newsLoop = new WP_Query( $newsArgs );                  					
			while ( $newsLoop->have_posts() ) : $newsLoop->the_post();              ?>
		
				<option value="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></option>
	
			<?php endwhile; ?>
			
		</select>
		<br>
		<br>
		<label for="inputValorQtde">Quantidade: </label>
		<input type="number" name="campo_quantidade" id="inputValorQtde" value="<?php echo $campoQtde; ?>" min="1"/>
		<br>
		<br>
	<?php
    }
	
	
add_action('save_post', 'save_pedidos_post');

function save_pedidos_post(){
    global $post;  
	update_post_meta($post->ID, 'campo_pedido_cliente', $_POST['campo_pedido_cliente']);
	update_post_meta($post->ID, 'campo_pedido_produto', $_POST['campo_pedido_produto']);
    update_post_meta($post->ID, 'campo_quantidade', $_POST['campo_quantidade']);
    }






/*=================PRODUTOS=================*/

add_action('init', 'type_post_produtos');
 
function type_post_produtos() { 
	$labels = array(
		'name' => _x('Produtos', 'post type general name'),
		'singular_name' => _x('Produto', 'post type singular name'),
		'add_new' => _x('Adicionar Novo', 'Novo item'),
		'add_new_item' => __('Novo Item'),
		'edit_item' => __('Editar Item'),
		'new_item' => __('Novo Item'),
		'view_item' => __('Ver Item'),
		'search_items' => __('Procurar Itens'),
		'not_found' =>  __('Nenhum registro encontrado'),
		'not_found_in_trash' => __('Nenhum registro encontrado na lixeira'),
		'parent_item_colon' => '',
		'menu_name' => 'Produtos');
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'public_queryable' => true,
		'show_ui' => true,			
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => null,
		'register_meta_box_cb' => 'produtos_meta_box',		
		'supports' => array('title','editor'));
 
	register_post_type( 'produtos' , $args );
	flush_rewrite_rules();
	}

	
register_taxonomy(
	"categoriasprodutos", 
    "produtos", 
      array(            
      	"label" => "Categorias", 
            "singular_label" => "Categoria", 
            "rewrite" => true,
            "hierarchical" => true)
	);

function produtos_meta_box(){        
    add_meta_box('campos_produto', __('Informações'), 'campos_produto', 'produtos', 'side', 'high');
}

function campos_produto(){
	global $post;
    $campoPreco = get_post_meta($post->ID, 'campo_preco', true); 
	?>        
		<br>
		<label for="inputValorPreco">Preço: </label>
		<input type="text" name="campo_preco" id="inputValorPreco" value="<?php echo $campoPreco; ?>" />
		<br>
		<br>
	<?php
    }
	
	
add_action('save_post', 'save_produtos_post');

function save_produtos_post(){
    global $post;        
    update_post_meta($post->ID, 'campo_preco', $_POST['campo_preco']);
    }
	
	
	
	
	
	
/*=================CLIENTES=================*/

add_action('init', 'type_post_clientes');
 
function type_post_clientes() { 
	$labels = array(
		'name' => _x('Clientes', 'post type general name'),
		'singular_name' => _x('Cliente', 'post type singular name'),
		'add_new' => _x('Adicionar Novo', 'Novo item'),
		'add_new_item' => __('Novo Item'),
		'edit_item' => __('Editar Item'),
		'new_item' => __('Novo Item'),
		'view_item' => __('Ver Item'),
		'search_items' => __('Procurar Itens'),
		'not_found' =>  __('Nenhum registro encontrado'),
		'not_found_in_trash' => __('Nenhum registro encontrado na lixeira'),
		'parent_item_colon' => '',
		'menu_name' => 'Clientes');
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'public_queryable' => true,
		'show_ui' => true,			
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => null,
		'register_meta_box_cb' => 'clientes_meta_box',		
		'supports' => array('title','editor'));
 
	register_post_type( 'clientes' , $args );
	flush_rewrite_rules();
	}

register_taxonomy(
	"categoriasclientes", 
    "clientes", 
      array(            
      	"label" => "Categorias", 
            "singular_label" => "Categoria", 
            "rewrite" => true,
            "hierarchical" => true)
	);

function clientes_meta_box(){        
    add_meta_box('campos_cliente', __('Informações'), 'campos_cliente', 'clientes', 'side', 'high');
}

function campos_cliente(){
	global $post;
    $campoEmail = get_post_meta($post->ID, 'campo_email', true); 
	?>        
		<br>
		<label for="inputValorEmail">E-mail: </label>
		<input type="text" name="campo_email" id="inputValorEmail" value="<?php echo $campoEmail; ?>" />
		<br>
		<br>
	<?php
	
	global $post;
    $campoTelefone = get_post_meta($post->ID, 'campo_telefone', true); 
	?>        
		<label for="inputValorTelefone">Telefone: </label>
		<input type="text" name="campo_telefone" id="inputValorTelefone" value="<?php echo $campoTelefone; ?>" />
		<br>
		<br>
	<?php
    }
	
	
add_action('save_post', 'save_clientes_post');

function save_clientes_post(){
    global $post;        
    update_post_meta($post->ID, 'campo_email', $_POST['campo_email']);
	update_post_meta($post->ID, 'campo_telefone', $_POST['campo_telefone']);
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	