<form action="login.php" method="post"
style="width:245px; padding:3px; text-align:center; margin: 10px 0px;">

	<input type="text"
	name="username"
	placeholder="User"
	style="width:200px;
			height:30px;
			color:#c18a05;
			padding:4px;
			border:0px;
			box-shadow:0px 1px 6px rgba(0,0,0,0.4);
			border-radius:5px 5px 0px 0px;"
	required/>

	<input type="password"
	name="password"
	placeholder="Password"
	style="width:200px;
			height:30px;
			color:#c18a05;
			padding:4px;
			border:0px;
			box-shadow:0px 3px 6px rgba(0,0,0,0.4);
			border-radius:0px 0px 5px 5px;"
	required/>
	
	<table cellspacing="0px" cellpadding="0px" style="text-align:center; width:200px; margin:15px auto 15px auto;">
		<tr>
		 <td colspan="2" style="padding:0px; margin:0px; border:0px;">
			<input type="submit" value="Login" class="defaultBtn"
			style="width:100%; font-size:13pt; font-weight:bold; border-radius:4px 4px 0px 0px; maring:0px;"/>
		 </td>
		</tr>
		
		<tr style="padding:0px; margin:0px; border:0px;">
		 <td style="padding:0px; margin:0px; border:0px;">
			<a href="register.php" class="defaultBtn" style="padding:1px 25px; border-radius:0px 0px 0px 4px; color:#fff;">Register</a>
		 </td>
		 
		 <td style="padding:0px; margin:0px; border:0px;">
			<a href="register.php" class="defaultBtn" style="padding:1px 25px; border-radius:0px 0px 4px 0px; color:#fff;">Forgot?</a>
		 </td>
		</tr>
		
	</table>
</form>
