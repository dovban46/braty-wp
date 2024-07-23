<section class="hero">
	<div class="container">
		<div class="hero__slider swiper">
			<div class="hero__wrapper swiper-wrapper my-4">
				<?php
				$slides = get_sub_field('slides');

				if ($slides) { ?>
					<?php foreach ($slides as $slide) { ?>
						<div class="hero__slide swiper-slide ">
							<div class="hero__slide-content">
								<h1 class="hero__slide-title "><?php echo html_entity_decode(esc_html($slide['title'])); ?><h1>
								<p class="hero__slide-text "><?php echo esc_html($slide['text']); ?></p>
								<a href="<?php echo esc_url($slide['button']['url']); ?>"
									class="hero__slide-btn btn mt-3"><?php echo esc_html($slide['button']['title']); ?></a>
							</div>
							<div class="hero__slide-image col-md-8">
								<img class="desktop-img" src="<?php echo esc_url($slide['img']); ?>" alt="hero-img">
								<img class="mobile-img" src="<?php echo esc_url($slide['mobile_img']); ?>" alt="hero-img">
							</div>
						</div>
					<?php } ?>
				<?php } ?>
			</div>
			<div class="hero-pagination"></div>
		</div>
	</div>
</section>









