@extends('layouts.layout')
@section('user')
    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
@endsection
@section('header')
    User Information
@endsection
@section('page')
    User
@endsection
@section('liSection')
    <li class="active">View User</li>
@endsection
@section('content')

			<div class="col-md-12">
				<div class="panel panel-default articles">
					<div class="panel-heading">
                        @if($user->extension == NULL)
						    {{ strtoupper($user->first_name) }} {{ strtoupper($user->middle_name) }} {{ strtoupper($user->last_name) }}
						@else
                            {{ strtoupper($user->first_name) }} {{ strtoupper($user->middle_name) }} {{ strtoupper($user->last_name) }} {{ strtoupper($user->extension) }}
                        @endif    
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fas fa-caret-down"></em></span></div>
					<div class="panel-body articles-container">
                        <div class="row">
							<div class="col-md-6">
								<form action="{{ route('admin.updateUser', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <label for="email">Email</label>
                                    <input type="email" name="email" value=" {{ $user->email }}" class="form-control" required>
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" value=" {{ $user->first_name }}" class="form-control" required>
                                    <label for="middle_name">Middle Name</label>
                                    <input type="text" name="middle_name" value=" {{ $user->middle_name }}" class="form-control" required>
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" value=" {{ $user->last_name }}" class="form-control" required>
                                    <label for="extension">Extension</label>
                                    <input type="text" name="extension" value=" {{ $user->extension }}" class="form-control">
                                    <br>
                                    <button class="btn btn-success form-control">Update</button>
                                </form>
                                
                                <form action="{{ route('admin.resetPassword', $user->id) }}" id="resetPasswordForm" method="POST">
                                    @method('PATCH')
                                    @csrf
                                    <a href="javascript:{}" onclick="document.getElementById('resetPasswordForm').submit();"  style="color: #3b34ad; text-decoration: none;">Reset Password</a>

                                </form>
							</div>	
						</div>
                    </div>
								
									
									
			</div><!--/.col-->
			


@endsection

@section('customScript')
<script>
    $(document).ready( function () {
        $('#booksTable').DataTable();
    } );
    $('#myModal').on('shown.bs.modal', function () {
     $('#myInput').focus()
    });
</script>

@endsection