<section class="about">
	<div class="container">
		<div class="about__container row">
			<?php
				if( have_rows('about_braty') ):
					while ( have_rows('about_braty') ) : the_row(); 
			?>
			<div class="col-md-7 about__image">
				<img src="<?php the_sub_field('image'); ?>" alt="CAFÉ BRATY" class="img-responsive rounded">
			</div>
			<div class="col-md-5 about__info">
				<div class="about__head">
					<h2 class="about__title"><?php the_sub_field('name'); ?></h2>
					<h3 class="about__subtitle"><?php the_sub_field('subtitle'); ?></h3>
				</div>
				<div class="about__text">
					<p class="text"><?php the_sub_field('text'); ?></p>
				</div>
				<div class="about__location">
					<img src="<?php the_sub_field('img-location'); ?>" alt="location" class="img-location">
					<p class="location"><?php the_sub_field('location'); ?></p>
				</div>
			</div>
			<?php
					endwhile;
				endif; 
			?>
		</div>
	</div>
</section>