
<script type="text/javascript" src="../sivec/assets/e1b61f1c/jQuery-2.1.4.min.js"></script>
<script type="text/javascript" src="http://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>




<link rel="stylesheet" href="http://twitter.github.io/typeahead.js/css/examples.css">

	<div id="prefetch">
  <input class="typeahead" type="text" placeholder="Countries">
</div>

<script type="text/javascript" charset="utf-8">
   
	  $(function()
	  {  
	  		//combo cliente 

			ddd(); 
	  }); 

function ddd(){ 
	var countries = new Bloodhound({
	  datumTokenizer: Bloodhound.tokenizers.whitespace,
	  queryTokenizer: Bloodhound.tokenizers.whitespace,
	  // url points to a json file that contains an array of country names, see
	  // https://github.com/twitter/typeahead.js/blob/gh-pages/data/countries.json
	  prefetch: 'countries.json'
	});

	// passing in `null` for the `options` arguments will result in the default
	// options being used
	$('#prefetch .typeahead').typeahead(null, {
	  name: 'countries',
	  source: countries
	});
}

</script>