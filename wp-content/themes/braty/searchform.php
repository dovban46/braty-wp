<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( `/` ) ); ?>">
    <label>
        <input type="search" class="search-field" placeholder="Пошук..." value="<?php echo get_search_query(); ?>" name="s" />
    </label>
    <button type="submit" class="search-submit">
		<img src="<?php echo get_template_directory_uri(); ?>/assets/images/search.svg" alt="search">
	</button>
</form>