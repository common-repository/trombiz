<?php
/*
Plugin Name: Trombiz
Plugin URI: http://www.trombiz.com
Description: Affiche les dernières photos de votre compte trombiz
Version: 1.0
Author: trombiz
Author URI: http://www.trombiz.com
*/

class Trombiz_Widget extends WP_Widget {
	function Trombiz_Widget() {
		parent::WP_Widget( false, $name = 'Trombiz Plugin' );	
	}
	
	function widget( $args, $instance ) {
		echo '<div style="text-align: center;">';
			echo '<script src="http://www.trombiz.com/ejs.php?u='.$instance['user'].'&n='.$instance['num_posts'].'&iw='.$instance['img_width'].'&txt='.$instance['txt_link'].'"></script>';
		echo '</div>';
	}
	
	function form( $instance ) {
		$num_posts = intval($instance['num_posts']);
		$img_width = intval($instance['img_width']);
		
		if(empty($img_width)) $img_width=120;
		if(empty($instance['txt_link'])) $instance['txt_link']='Prendre une photo';
		
		// if ($num_posts<1 OR $num_posts>12) $num_posts=1;
		?>
		Nombre d'images : <select id="<?php echo $this->get_field_id('num_posts'); ?>" name="<?php echo $this->get_field_name( 'num_posts' ); ?>">
		<?php
			for($i=1; $i<=8; ++$i){
				echo '<option value="'.$i.'" '.($instance['num_posts'] == $i ? 'selected="selected"' : '').'>'.$i.' &nbsp;</option>'."\n";
			}
		?>
		</select>
		<br />
		<p><label for="<?php echo $this->get_field_id( 'img_width' ); ?>"><?php _e( 'Largeur image:' ); ?> <input class="widefat" id="<?php echo $this->get_field_id( 'img_width' ); ?>" name="<?php echo $this->get_field_name( 'img_width' ); ?>" type="text" value="<?php echo $img_width; ?>" /></label></p>		
		<p><label for="<?php echo $this->get_field_id('user'); ?>"><?php _e('Nom du compte : '); ?> <input class="widefat" id="<?php echo $this->get_field_id('user'); ?>" name="<?php echo $this->get_field_name('user'); ?>" type="text" value="<?php echo $instance['user']; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('txt_link'); ?>"><?php _e('Texte du lien : '); ?> <input class="widefat" id="<?php echo $this->get_field_id('txt_link'); ?>" name="<?php echo $this->get_field_name('txt_link'); ?>" type="text" value="<?php echo $instance['txt_link']; ?>" /></label></p>
		<center><a href="http://www.trombiz.com/p-register" target="_blank">Pas inscrit sur trombiz ?</a></center>
        <?php 
	}	
}

add_action( 'widgets_init', create_function( '', 'return register_widget( "Trombiz_Widget" );' ) );
?>
