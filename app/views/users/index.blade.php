@extends('layouts.master')

@section('title')
@parent
:: Home
@stop

@section('content')
<h2><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Korisnici</h2>
 @if ($users->count())
	<table class="table table-condensed table-hover">

	@foreach ($users as $user)

	<tr><td>{{ link_to("/users/{$user->id}", Str::upper($user->fname." ".$user->lname)) }}</td></tr>
	
	@endforeach

	</table>
	    {{ $users->links() }}
	@else
	<div class="alert alert-warning" role="alert">
	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	<strong>Nema rezultata</strong><br>
	Ukoliko ovo nije očekivani ishod vaše pretrage molimo Vas da kontaktirate Administratora</div>
	@endif
@stop


