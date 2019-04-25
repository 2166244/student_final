				<div id="footer">
					<div class="row">
						<p class="copy">&copy 2019. Bakakeng National Highschool, Baguio City</p>
					</div>
				</div>
			</div>
		</div>
		<script src="<?php echo URL; ?>public/scripts/responsive-menu.js"></script>
		<script src="<?php echo URL; ?>public/scripts/sitescripts.js"></script>
		<?php if( $this->siteInfo['cookie'] ): ?>
		<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
		<?php endif; ?>
		<?php
		echo "<script>setInterval(function(){ 
		    $('.menu-top .menu-top-right .info .btn-group .notification .count').load('".str_replace('url=', '', $_SERVER['QUERY_STRING'])." .menu-top .menu-top-right .info .btn-group .notification .count');
		}, 5000);</script>";
		?>
	</body>
</html>


