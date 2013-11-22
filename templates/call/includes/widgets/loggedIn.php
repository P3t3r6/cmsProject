<div style="text-align:center; width:200px; margin:15px auto 15px auto;">

	Welcome <?php echo $userData['username']; ?>

	</br>

	<a href="myaccount.php" class="defaultBtn" style="display:block; width:200px; font-size:9pt; padding:3px 0px; margin:2px auto; border-radius:4px;">My account</a>

	<form action="logout.php" method="post">
		<input type="submit" value="Logout" class="defaultBtn" style="display:block; width:200px; font-size:9pt; padding:3px 0px; margin:2px auto; border-radius:4px;"/>
	</form>
	
</div>


<!--
<ul>
	<li><a href="">1</a></li>
	<li><a href="">2</a></li>
	<li><a href="">3</a></li>
</ul>
-->