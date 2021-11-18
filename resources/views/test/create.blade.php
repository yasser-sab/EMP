@extends('layouts.app')
@section('content')
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script> -->

<?php
if(isset($_GET['name'])){
echo $_GET['name'];
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<!-- <form method="GET" id="myform" action="http://localhost/Emplois_v2/public/test/create/" enctype="application/x-www-form-urlencoded"> -->
					<input onclick="loadDoc()" type="submit" id="btn" value="ok" name="">
				<div id="text"></div>
				<!-- </form> -->
		</div>
		
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
	function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
    }
  };
  xhttp.open("GET", "http://localhost/Emplois_v2/public/test/create/", true);
  xhttp.send();
}
// $(document).ready(function(){
// 	$("#btn").click(function(){
// 		$.ajax({
// 	    'method': 'GET'
// 	    , 'data': {'name':'yasser'}
// 	    , beforeSend: function(xhr){

// 	    }
// 	    , complete: function(){ 
// 	    }  
// 	    , success: function(html,two,tree){ 
// 	        console.log(html); 
// 	    }
// 		});
// 	});
// });
</script>



@endsection




















