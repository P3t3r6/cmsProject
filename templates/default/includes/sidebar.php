<label id="lmhButton" for="loginMenuHidder" onClick="stickyFooter()">&equiv;
	<span id="lmhName">
		<?php
			if (loggedIn() === true){
				echo $userData['username'];
			} else {
				echo 'Hi Guest!';
			}
		?>		
	</span>
</label>

<script type="text/javascript">
	function stickyFooter(){
		//alert('s1. loginMenu ' + $('#loginMenu').css('left') + '  footer ' + $('#footer').css('left'));
		
		if ($('#loginMenu').css('-webkit-transform') === 'translate(0px,0px)'){
			$('#footer').css('-webkit-transform', 'translate(0px,0px)');
			setTimeout(function(){ $('body').css('overflow-x', 'auto'); },500);
		}
		
		if ($('#loginMenu').css('-webkit-transform') === 'translate(-250px,0px)'){
			$('#footer').css('-webkit-transform', 'translate(250px,0px)');
			$('body').css('overflow-x', 'hidden');
		}
		
		//alert('2. loginMenu ' + $('#loginMenu').css('left') + '  footer ' + $('#footer').css('left'));
	}
	
	function updateFooter(){
		//alert('u1. loginMenu ' + $('#loginMenu').css('left') + '  footer ' + $('#footer').css('left'));
		
		if ($('#loginMenu').css('-webkit-transform') === 'translate(-250px,0px)'){
			$('#footer').css('-webkit-transform', 'translate(0px,0px)');
			setTimeout(function(){ $('body').css('overflow-x', 'auto'); },500);
		}
		
		if ($('#loginMenu').css('-webkit-transform') === 'translate(0px,0px)'){
			$('#footer').css('-webkit-transform', 'translate(250px,0px)');
			$('body').css('overflow-x', 'hidden');
		}
		
		//alert('2. loginMenu ' + $('#loginMenu').css('left') + '  footer ' + $('#footer').css('left'));
	}
	
	$(window).scroll(function(){
		if ($(this).scrollTop() > 120) {
			$('#lmhName').css('opacity', 0);
			$('#lmhName').css('left', 20);
			$('#lmhName').css('visibility', 'hidden');
		} else {
			$('#lmhName').css('opacity', 100);
			$('#lmhName').css('left', 31);
			$('#lmhName').css('visibility', 'visible');
		}
	});
</script>

<br />

<?php
if (loggedIn() === false){
	include $templatePath . 'includes/widgets/login.php';
} else {
	include $templatePath . 'includes/widgets/loggedIn.php';
}
?>