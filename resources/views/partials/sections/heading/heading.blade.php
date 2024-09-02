<section>
	@dump(get_defined_vars())
	@if (isset($content) && !empty($content))
		<h1>{{ $content }}</h1>
	@endif

</section>
