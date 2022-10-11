<?php
/* Custom search form */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <input type="search" class="search-field" placeholder="Rechercher..." value name="s">
    <button type="submit" class="search-submit"><span class="dashicons dashicons-search"></span></button>
    <span class="dashicons dashicons-search close-icon"></span>
</form>

<script>
let search = document.querySelector(".search-form");
let button = document.querySelector(".search-submit");
search.addEventListener('click', (event) => {
    search.classList.add("open")
});
</script>