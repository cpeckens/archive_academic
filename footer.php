		<div id="container-foot">
			
			<div id="footer">
				
				<div id="footer-left">
					<p><a><strong>Quick Links:</strong></a> <a href="http://my.johnshopkins.edu" target="_blank">My Johns Hopkins</a> | <a href="http://jhem.johnshopkins.edu" target="_blank">JHEM</a></p>
					<p><a href="http://www.jhu.edu">Johns Hopkins University</a> | <a href="http://krieger.jhu.edu">Zanvyl Krieger School of Arts and Sciences</a></p>
					<?php if (is_front_page()) { ?>
					<?php get_sidebar('address-sb'); ?>
					<?php } ?>
					<small>&copy; Johns Hopkins University. All rights reserved.</small>
				</div>
				
				<div id="footer-right">
						<ul id="social-media">
							<a href="http://www.facebook.com"><li class="facebook"><span>Facebook</span></li></a>
							<a href="http://www.youtube.com/user/johnshopkins"><li class="youtube"><span>Youtube</span></li></a>
							<a href="<?php bloginfo('url'); ?>/feed"><li class="rss"><span>RSS</span></li></a>
						</ul>
				
				</div>
				
			</div> <!--End footer -->
			
			<div class="clearboth"></div> <!--to have background work properly -->
		</div> <!--End container-foot -->

	</body>
		<script src="<?php network_home_url(); ?>/min/?f=wp-content/themes/academic/assets/js/respond.min.js,wp-content/themes/academic/assets/js/ksas_custom.js<?php if (is_front_page()) { ?>,wp-content/themes/academic/assets/js/ksas_frontpage.js<?php } ?>&1"></script>
		<?php wp_footer(); ?>
</html>

