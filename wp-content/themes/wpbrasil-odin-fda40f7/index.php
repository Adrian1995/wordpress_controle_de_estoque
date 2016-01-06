<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Odin
 * @since 2.2.0
 */

get_header(); ?>

	<main id="content" class="<?php echo odin_classes_page_sidebar(); ?>" tabindex="-1" role="main">
		
		<h4>Pedidos</h4>
		
		<table class="table">
		<thead>
			<th>ID</th>
			<th>Produto</th>
			<th>Cliente</th>
			<th>Quantidade</th>
		</thead>
		<?php 
		$newsArgs = array( 'post_type' => 'pedidos', 'posts_per_page' => 4);                   					
		$newsLoop = new WP_Query( $newsArgs );                  					
		while ( $newsLoop->have_posts() ) : $newsLoop->the_post();              ?>
		
			<tbody>
				<td><?php echo $id; ?></td>
				<td><?php echo get_post_meta($post->ID, 'campo_pedido_produto', true); ?></td>
				<td><?php echo get_post_meta($post->ID, 'campo_pedido_cliente', true); ?></td>
				<td><?php echo get_post_meta($post->ID, 'campo_quantidade', true); ?></td>
			</tbody>
	
		<?php endwhile; ?>
		</table>
		
		
		<br>
		<br>
		
		
		<h4>Produtos</h4>
		
		<table class="table">
		<thead>
			<th>ID</th>
			<th>Nome</th>
			<th>Descrição</th>
			<th>Valor</th>
		</thead>
		<?php 
		$newsArgs = array( 'post_type' => 'produtos', 'posts_per_page' => 4);                   					
		$newsLoop = new WP_Query( $newsArgs );                  					
		while ( $newsLoop->have_posts() ) : $newsLoop->the_post();              ?>
		
			<tbody>
				<td><?php echo $id; ?></td>
				<td><?php echo get_the_title(); ?></td>
				<td><?php echo get_the_content(); ?></td>
				<td>R$ <?php echo get_post_meta($post->ID, 'campo_preco', true); ?></td>
			</tbody>
	
		<?php endwhile; ?>
		</table>
		
		
		<br>
		<br>
		
		
		<h4>Clientes</h4>
		
		<table class="table">
		<thead>
			<th>ID</th>
			<th>Nome</th>
			<th>E-mail</th>
			<th>Telefone</th>
		</thead>
		<?php 
		$newsArgs = array( 'post_type' => 'clientes', 'posts_per_page' => 4);                   					
		$newsLoop = new WP_Query( $newsArgs );                  					
		while ( $newsLoop->have_posts() ) : $newsLoop->the_post();              ?>
		
			<tbody>
				<td><?php echo $id; ?></td>
				<td><?php echo get_the_title(); ?></td>
				<td><?php echo get_post_meta($post->ID, 'campo_email', true); ?></td>
				<td><?php echo get_post_meta($post->ID, 'campo_telefone', true); ?></td>
			</tbody>
	
		<?php endwhile; ?>
		</table>

	</main><!-- #content -->

<?php
get_sidebar();
get_footer();
