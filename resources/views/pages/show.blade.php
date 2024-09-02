@if (isset($sections) && !empty($sections))
	@foreach ($sections as $section)
		{!! $section !!}
	@endforeach
@endif
