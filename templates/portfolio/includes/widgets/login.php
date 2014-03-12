<form action="login" method="get"
style="width:300px; padding:3px; text-align:center; margin: 10px 0px;">

	<input type="text" name="username" placeholder="User" required/>

	<input type="password" name="password" placeholder="Password" required/>
	
	<table cellspacing="0px" cellpadding="0px" style="margin:15px auto 15px auto; border:1px solid red;">
		<tr>
		 <td colspan="2" style="padding:0px; margin:0px; border:1px solid red;">
			<input type="submit" value="Login" class="defaultBtn"/>
		 </td>
		</tr>
		
		<tr style="padding:0px; margin:0px; border:0px;">
		 <td style="padding:0px; margin:0px; border:0px;">
			<a href="register.php" class="defaultBtn">Register</a>
		 </td>
		 
		 <td style="padding:0px; margin:0px; border:0px;">
			<a class="defaultBtn" style="padding:1px 25px; border-radius:0px 0px 4px 0px; color:#fff;">Forgot?</a>
		 </td>
		</tr>
		
	</table>
	
	<style type="text/css">
	td{
		border:0px solid green;
		margin:0px;
		padding:0px;
	}
	</style>
	
	<table cellspacing="0px" style="margin:0px auto;">
		<tr>
			<td colspan="2" style="margin:0px; padding:0px;"><button style="margin:0px; padding:10px 71px;">Login</button></td>
		</tr>
		<tr>
			<td style="margin:0px; padding:0px;">
				<button style="margin:0px; display:block; width:100%;">Register</button>
			</td>
			
			<td style="margin:0px; padding:0px;">
				<button href="register.php" style="margin:0px; display:block; width:100%;">Forgot?</button>
			</td>
		</tr>
	</table>
</form>
