			</div> <!-- /Inside Content -->
			<div class="wrap_footer">
				<?php echo apply_filters( 'tripgo_render_footer', '' ); ?>
			</div>
			<form>
			<input type="number" name="bola" data-fdg = "3" onclick="function home_s(event){console.log('you just click on me 1')} return false;" minLength=2 maxLength=9 />
			<select name="list" >
				<option>A</option>
				<option>B</option>
				<option>C</option>
				<option>D</option>
				<option>E</option>
			</select>
			<button>Submit</button>
		</form>
		</div> <!-- Ova Wrapper -->	
		<?php wp_footer(); ?>
	</body><!-- /body -->
</html>