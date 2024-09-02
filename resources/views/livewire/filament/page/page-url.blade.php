<div>

	@if ($slug)
		<a class="text-sm text-blue-500 hover:underline" href="{!! route('page.show', ['page' => $slug]) !!}" target="_blank">
			View Page: {{ route('page.show', ['page' => $slug]) }}
		</a>
	@endif

</div>
