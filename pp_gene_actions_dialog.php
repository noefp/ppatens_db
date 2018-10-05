<div id="dlgGeneActions">
</div>
<script type="text/javascript">
  $( function() {
	  $("#dlgGeneActions").dialog({title:"Select action to perform with selected gene:", autoOpen:false, modal:true,
	  open:function() {
		    if($(this).data("gname").trim()!=$(this).data("curGName").trim())
			{
				var btnAnnotText="Search annotations for latest version of this gene.";
				var usedGName=$(this).data("curGName").trim();
			}
			else
			{
								var btnAnnotText="Search annotations";
				var usedGName=$(this).data("gname");
			}
		  $("#dlgGeneActions").dialog({closeText:"Close", buttons:[
{text:btnAnnotText, click:function(){window.open(`pp_annot.php?name=${usedGName}`);}}
		  ]});
	  }
	  });
  });
</script>