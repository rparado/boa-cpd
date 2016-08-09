<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<label class="search-form__lbl" for="s">Search for:</label>
	<input type="text" value="Search" onfocus="if( this.value == this.defaultValue ) this.value = ''" onblur="if( this.value == '' ) this.value = this.defaultValue" name="s" id="s" />
	<button type="submit" class="search-form__submit" name="searchsubmit">Search</button>
</form>