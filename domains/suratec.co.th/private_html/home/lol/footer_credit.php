<div class="footer-bottom">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<!-- Copyright -->
								<div class="copyright">
									<?php $copyright_Y = '2019'; ?>
               <span style="color: #FFFFFF">Copyright &copy; <?=$copyright_Y?> - <?php if($copyright_Y === date('Y')){echo 'Present.';}else{echo date('Y');}?> www.suratec.co.th, All Right Reserved. Developed by <a href="https://www.tpse.co.th" target="_blank"><span>TPS Enterprise</span> </a>
								</div>
								<!--/ End Copyright -->
							</div>
						</div>
					</div>
				</div>
			</footer>
			<!-- Jquery JS -->
			<script src="../js/jquery.min.js"></script>
			<script src="../js/jquery-migrate.min.js"></script>
			<script src="../js/jquery-ui.min.js"></script>
			<!-- Bootstrap JS -->
			<script src="../js/popper.min.js"></script>
			<script src="../js/bootstrap.min.js"></script>
			<!-- Modernizer JS -->
			<script src="../js/modernizr.min.js"></script>
			<!-- Particles JS -->
			<script src="../js/particles.min.js"></script>
			<!-- Theme Plugins JS -->
			<script src="../js/theme-plugins.js"></script>
			<!-- Main JS -->
			<script src="../js/main.js"></script>

<script type="text/javascript">
  $('.logout').click(function(){  
        let logout = new FormData();
        logout.append('action','logout');
           //var logout = "logout";  
           $.ajax({  
                url: "../library/function_g.php",  
                method: "POST",  
                data: logout,  
                processData: false,
                contentType: false,
                success:function(data)  
                {  
                  //console.log(data);
                  //alert(data.message);
                location;
                }  
           });  
      });  
</script>
