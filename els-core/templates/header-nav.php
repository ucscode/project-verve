<?php defined("ROOT_DIR") or die; ?>

<header class="text-bg-dark position-sticky">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Fifth navbar example">
		<div class="container">
		
			<a class="navbar-brand" href="<?php echo core::url(); ?>">
				<img src='<?php echo core::url( self::$LOGO ); ?>' width="40" role="img" aria-label="Bootstrap">
			</a>
			
			<button class="navbar-toggler hamburger hamburger--spin" type="button" data-bs-toggle="collapse" data-bs-target="#navbars" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon d-none"></span>
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</button>

			<div class="collapse navbar-collapse" id="navbars">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<?php
					
						global $Menu;
						
						$Menu->enlist(null, function($data, $name, $Menu) {
							
							ob_start();
							
							$attr = array("class" => "nav-link ");
							
							if( !empty($data['submenu']) ) {
								$attr['data-bs-toggle'] = 'dropdown';
								$attr['aria-expanded'] = 'false';
								$attr['href'] = 'javascript:void(0)';
								$attr['class'] .= ' dropdown-toggle';
							} else $attr['href'] = strip_tags($data['link']);
							
							
							if( ($data['active'] ?? false) ) {
								$attr['class'] .= ' active';
								$attr['aria-current'] = 'page';
							};
							
					?>
					
					<li class="nav-item <?php if(!empty($data['submenu'])) echo 'dropdown'; ?>">
					
						<a <?php echo core::array_to_html_attrs( $attr ); ?>>
							<?php echo $data['label']; ?>
						</a>
						
						<?php if( !empty($data['submenu']) ): ?>
						
						<ul class="dropdown-menu">
						
							<?php $Menu->enlist($data['submenu'], function($data) { ?>
							
							<li>
								<a class="dropdown-item" href="<?php echo $data['link']; ?>">
									<?php echo $data['label']; ?>
								</a>
							</li>
							
							<?php }); ?>
							
						</ul>
						
						<?php endif; ?>
						
					</li>
					
					<?php 
							$items = ob_get_clean();
							return $items;
						});
					?>
				</ul>
				
				<?php if( $page->nav_search ?? true ): ?>
					<form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
						<input type="search" name='search' class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search" value='<?php echo $_GET['search'] ?? ''; ?>'>
						<?php 
							foreach( $_GET as $name => $value ): 
								if( $name == 'search' ) continue;
						?>
						<input type='hidden' name='<?php echo $name; ?>' value="<?php echo $value; ?>">
						<?php endforeach; ?>
					</form>
				<?php endif; ?>
				
				<div class="text-end">
					<?php events::exec('@nav:right'); ?>
				</div>
				
			</div>
		</div>
	</nav>
</header>