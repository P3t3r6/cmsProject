	
	<script type="text/javascript">
	
	function showSlider()
		{
			document.getElementById("sliderContainer").style.display="block";
		}
		
	
	function closeSlider()
		{
			document.getElementById("sliderContainer").style.display="none";
		}
	
	</script>

<div id="sliderContainer"
	style="display:none;
	width:100%;
	background:rgba(0,0,0,0.8);
	z-index:100;
	height: auto !important;
	min-height: 100%;
	height: 100%;
	position: fixed;
	top:0px; left:0px;">
	
	<div onClick="closeSlider()"
	style="	width:100%;
	height: auto !important;
	min-height: 100%;
	height: 100%;
	position: fixed;
	top:0px; left:0px;"></div>
	
<a onClick="closeSlider()"
	class="defaultBtn"
	style="padding:15px;
			border-radius:4px;
			position:fixed;
			top:35px; right:50px;
			cursor:pointer;">
			Close</a>
	
		<center>
		 <div style="padding-top:10%;">
			<div id="a1">
			 <div id="a2">
			  <div id="a3">
				<div class="pages">
			   <!-- First Page #a1 -->
				<div id="i1" class="page">
					<a href="#a2"><img src="http://sphotos-b.ak.fbcdn.net/hphotos-ak-ash3/q77/s720x720/944144_303375496464638_812809962_n.jpg"></a>
				</div>
			
				<!-- Second Page #a2 -->
				<div id="i2" class="page">
					<a href="#a3"><img src="http://sphotos-c.ak.fbcdn.net/hphotos-ak-prn2/q71/s720x720/264841_299991980136323_692982561_n.jpg"></a>
				</div>
			
				<!-- Third Page #a3 -->
				<div id="i3" class="page">
					<a href="#a1"><img src="http://sphotos-a.ak.fbcdn.net/hphotos-ak-ash4/q75/s720x720/1002789_299275406874647_521792179_n.jpg"></a>
				</div>
				</div>			
		     </div>
		    </div>
		   </div>
		 </div>
		 </center>
	
</div>
