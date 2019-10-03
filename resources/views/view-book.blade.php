@extends('layouts.user-layout')
@section('user')
    Hello, {{ Auth::user()->first_name }}
@endsection
@section('header')
    Book Information
@endsection
@section('page')
   Book
@endsection
@section('content')
<div class="col-md-12">
				<div class="panel panel-default articles">
					<div class="panel-heading">
						{{ $book->book_title }} - {{ $book->author }}
						<ul class="pull-right panel-settings panel-button-tab-right">
							<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
								<em class="fa fa-cogs"></em>
							</a>
	
							</li>
						</ul>
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fas fa-caret-down"></em></span></div>
					<div class="panel-body articles-container">
                        <div class="row">
							<div class="col-md-6">
								<h3><p style="color: black;">Title: {{ $book->book_title }} </p>
								<p style="color: black;">Author: {{ $book->author }}</p>
								<p style="color: black;">Stocks: {{ $book->stocks }}</p></h4>
								<hr>
								@if($reservation == NULL || Carbon\Carbon::now()->addDays(1)->format('Y-m-d') >= $reservation->upto )
									<form action="{{ route('user.reserve') }}" method="POST">
										@csrf
										<input type="hidden" name="book_id" value="{{ $book->id }}">
										<button class="btn btn-success">Reserve this book</button>
										
									</form>
								


								@else
									<form action="{{ route('user.deleteReservation', $reservation->id) }}" method="POST">
										@method('DELETE')
										@csrf
										<button class="btn btn-success">Reserved. Up to {{ $reservation->upto }} (Click to cancel)</button>
									</form>		
								@endif

							</div>
							<div class="col-md-6">
								<div class="row">
									<div class=" col-lg-1 col-md-1 col-sm-2 col-xs-1"></div>
									<div class="col-lg-1 col-md-6 col-sm-6 col-xs-6">
										<h3><p><strong>#{{ $book->book_number }}</strong></p></h3>
									</div>
								</div>
									{!! QrCode::size(300)->generate($book->id .','.Auth::user()->id ); !!}
									<p>Save a screenshot of this qr including the book number above it.</p>
									

								
							</div>
						</div>
                    </div>
								
									
									
			</div><!--/.col-->
			
@endsection
