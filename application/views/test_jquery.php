<div id="content">
	<a href="<?=base_url();?>jquery/test_jquery_click" id="jquery">Test Jquery</a>
</div>
<script type="text/javascript">
	$('#jquery').live('click',function(e){
		e.preventDefault();
		console.log("live");
		$.ajax({
			url: '/jquery/click',
			data: {
				name: 'teresa'
			},
			success: function(html){
				console.log(html);
			},
			error: function(html){
				
			}
		});
	});
</script>