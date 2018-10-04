<div id="dlgGeneActions">
</div>
<script type="text/javascript">
  $( function() {
	  $("#dlgGeneActions").dialog({title:"Select action to perform with selected gene:", autoOpen:false,
	  open:function() {
		  $("#dlgGeneActions").dialog({buttons:[
			  { text:"close", click:function() {$(this).dialog("close")}},
				  {text:"Search for annotations", click:function(){window.open(`pp_annot.php?name=${$('#dlgGeneActions').data('gname')}`);}}
		  ]});
	  }
	  });
  });
</script>