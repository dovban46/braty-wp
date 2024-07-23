<section class="about_pizza">
	<div class="container">
		<div class="about_pizza_container row">
			<?php
				if( have_rows('about_pizza') ):
					while ( have_rows('about_pizza') ) : the_row(); 
			?>
			<div class="col-md-7 about_pizza_info">
				<div class="head_pizza">
					<h2 class="title"><?php the_sub_field('title'); ?></h2>
				</div>
				<div class="text_pizza">
					<p class="text_1"><?php the_sub_field('text_1'); ?></p>
                    <p class="text_2"><?php the_sub_field('text_2'); ?></p>
				</div>
			</div>
            <div class="col-md-5 about__image">
				<img src="<?php the_sub_field('image'); ?>" alt="CAFÉ BRATY" class="img-responsive rounded">
			</div>
			<?php
					endwhile;
				endif; 
			?>
		</div>
	</div>
</section>



