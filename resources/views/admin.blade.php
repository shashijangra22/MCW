@extends('home1main')

@section('content')
		@foreach ($users as $user)
			<div class="row">
				{{$user}}
			</div>
		@endforeach
@endsection

@section('jscript')

@endsection