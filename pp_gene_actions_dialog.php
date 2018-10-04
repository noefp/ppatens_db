<div id="dlgGeneActions">
</div>
<script type="text/javascript">
  $( function() {
	  $("#dlgGeneActions").dialog({title:"My testing dialog", autoOpen:false,
	  open:function() {
		  $("#dlgGeneActions").dialog({buttons:[
			  { text:"close", click:function() {$(this).dialog("close")}},
				  {text:"Search for annotations", click:function(){window.open("");}}
		  ]});
	  }
	  });
  });
</script>