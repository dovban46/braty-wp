<section class="navigation">
    <div class="container">
        <div class="custom-container d-flex align-items-center justify-content-around">
            <?php
				$navigations = get_sub_field('navigation-menu');
				if ($navigations) { ?>
					<?php foreach ($navigations as $navigation) { ?> 
                        <a href="<?php echo esc_url($navigation['name']['url']); ?>" class="custom-btn">
                            <img src="<?php echo esc_url($navigation['image']); ?>" alt="img" class="icon">
                            <?php echo esc_html($navigation['name']['title']); ?>
                        </a>
                <?php } ?>
			<?php } ?>
        </div>
    </div>
</section>
