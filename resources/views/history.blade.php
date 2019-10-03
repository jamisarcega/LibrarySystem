@extends('layouts.user-layout')
@section('user')
    Hello, {{ Auth::user()->first_name }}
@endsection
@section('header')
    Borrow History
@endsection
@section('page')
   History
@endsection
@section('content')
<div class="col-md-12">
				<div class="panel panel-default articles">
					<div class="panel-heading">
						
						<ul class="pull-right panel-settings panel-button-tab-right">
							<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
								<em class="fa fa-cogs"></em>
							</a>
	
							</li>
						</ul>
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fas fa-caret-down"></em></span></div>
					    <div class="panel-body articles-container">
                            <table id="historyTable">
                                <thead>
                                    <th>Book Title</th>
                                    <th>Author</th>
                                    <th>Date Borrowed</th>
                                    <th>Status</th>
                                    <th>Penalties</th>
                                </thead>
                                <tbody>
                                    @foreach($books as $book)
                                     <tr>
                                        <td>{{ $book->book->book_title }}</td>
                                        <td>{{ $book->book->author }}</td>
                                        <td>{{ $book->date_borrowed }}</td>
                                        @if($book->return_date == NULL)
                                            <td> <p class="text-danger">Not returned</p> </td>
                                        @else
                                            <td><p class="text-success">Returned: {{ $book->return_date }}</p></td> 
                                        @endif
                                        
                                      
                                        <p style="display: none"> {{ $parse = Carbon\Carbon::parse($book->date_borrowed) }}</p>
                                        <p style="display: none"> {{ $now = Carbon\Carbon::now() }}</p>
                                        <p style="display: none"> {{ $result = $parse->diffInDays($now) }}</p>

                                        @if($result > 3)
                                           {{ $penalty = $result - 3 }} 
                                            {{ $penalty = $penalty * 5 }}
                                            <td>PHP {{ $penalty }}</td>
                                        @else
                                            <td>PHP 0</td>    
                                        @endif
                                        
                                     </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            
						</div>
                    </div>
								
									
									
			</div><!--/.col-->
			
@endsection
@section('customScript')
<script>
    $(document).ready( function () {
        $('#historyTable').DataTable();
    } );
    $('#myModal').on('shown.bs.modal', function () {
     $('#myInput').focus()
    });
 
</script>

@endsection