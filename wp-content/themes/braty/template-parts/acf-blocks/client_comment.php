<section class="client-comments">
    <?php
    $args = array(
        'post_type' => 'client-comment',
        'orderby' => 'desc'
    );
    $client_comments = new WP_Query($args);
    ?>
	<div class="container">
		<div class="client-comments-wrapper swiper-container swiper-comment">
			<h3><?php the_sub_field('title'); ?></h3>
			<div class="swiper-wrapper">
				<?php while ($client_comments->have_posts()) : $client_comments->the_post();
					$client_comment_fields = get_field('client-comment');
					$rating = $client_comment_fields['rating'];
				?>
					<div class="swiper-slide comment-client">
						<div class="client-info">
							<div class="buyer-info">
								<?php if ($client_comment_fields['name']) : ?>
									<p class="client-name"><?php echo $client_comment_fields['name']; ?></p>
								<?php endif; ?>
							</div>
						</div>
						<div class="rating-date">
							<?php if ($client_comment_fields['date']) : ?>
								<p class="date"><?php echo str_replace('/', '.', $client_comment_fields['date']); ?></p>
							<?php else : ?>
								<p class="date"><?php echo get_the_date('d.m.Y'); ?></p>
							<?php endif; ?>

							<?php if ($rating) : ?>
								<div class="rating">
									<div class="stars">
										<?php for ($i = 1; $i <= 5; $i++) : ?>
											<?php $star_class = ($i <= $rating) ? 'filled' : 'gray'; ?>
											
											<?php
												for ($i = 1; $i <= 5; $i++) {
													if ($i <= $rating) {
														echo '<span class="comment-star-rating '.$star_class .'" data-rating="<?php echo $i; ?>">&#9733;</span>'; // Full star
													} else {
														echo '<span class="comment-star '.$star_class .'" data-rating="<?php echo $i; ?>">&#9733;</span>'; // Empty star
													}
												}
											?>	
											
										<?php endfor; ?>
									</div>

								</div>
							<?php endif; ?>

						</div>
						<?php if (strlen($client_comment_fields['comment']) > 150) : ?>
							<div class="comment-container">
								<p class="comment"><?php echo substr($client_comment_fields['comment'], 0, 150); ?><span class="comment-overflow"><?php echo substr($client_comment_fields['comment'], 150); ?></span></p>
								<button class="show-more-btn"><?php echo esc_html('Детальніше'); ?></button>
							</div>
						<?php else : ?>
							<p class="comment"><?php echo $client_comment_fields['comment']; ?></p>
						<?php endif; ?>
						
					</div>
					
				<?php endwhile; ?>
			</div>
			

			<!-- <div class="show-review-block">
				<a id="show-review-form"><?php echo esc_html('▾ Залишити відгук'); ?></a>
			</div> -->
<!-- 
			<form id="custom-review-form" method="post">

				<h3><?php echo esc_html('Залишити відгук'); ?></h3>

				<div class="rating">
					<label class="your-rating"><?php echo esc_html("Ваша оцінка"); ?></label>
					<div id="rating-stars">
						<?php for ($i = 1; $i <= 5; $i++) { ?>
							<span class="star" data-rating="<?php echo $i; ?>">&#9733;</span>
						<?php } ?>
					</div>
					<input type="hidden" name="rating" id="custom-rating" required>
				</div>

				<div class="one-line">
					<p>
						<label for="custom-name"><?php echo esc_html("Ім'я"); ?></label>
						<input type="text" name="custom_name" id="custom-name" placeholder="Введіть ваше ім'я" required>
					</p>

					<p>
						<label for="custom-phone"><?php echo esc_html('Номер телефону'); ?></label>
						<input type="tel" name="custom_phone" id="custom-phone" placeholder="+38(0ХХ) ХХХ ХХ ХХ" required>
					</p>
				</div>
					
				<p>
					<label for="custom-comment"><?php echo esc_html('Ваш відгук'); ?></label>
					<textarea name="custom_comment" id="custom-comment" placeholder="Введіть ваш коментар"></textarea>
				</p>

				<input type="hidden" name="product_id" value="<?php echo get_the_ID(); ?>">
				<p class="save-info">
					<input type="radio" name="save_info" id="save-info" value="yes">
					<label for="save-info"><?php echo esc_html("Зберегти мої імʼя та телефон, для подальших коментарів"); ?></label>
				</p>
				<p class="form-submit">
					<input type="submit" name="submit_custom_review" value="<?php echo esc_html('Надіслати відгук'); ?>">
				</p>

			</form> -->


			
		</div>
	</div>
    <?php wp_reset_postdata(); ?>
</section>
