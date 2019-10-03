@extends('layouts.layout')
@section('user')
    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
@endsection
@section('header')
    Users
@endsection
@section('page')
   Users
@endsection
@section('content')
@if (\Session::has('success'))
    <div class="col-md-12">
        <div class="alert bg-success" role="alert"><em class="far fa-lg fa-check-square">
            &nbsp;</em> {!! \Session::get('success') !!} <a href="#" class="pull-right"><em class="fa fa-lg fa-close"></em></a>
        </div>
    </div>
    @endif
			<div class="col-md-12">
				<div class="panel panel-default articles">
					<div class="panel-heading">
						Users
						<ul class="pull-right panel-settings panel-button-tab-right">
							<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
								<em class="fa fa-cogs"></em>
							</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li>
										<ul class="dropdown-settings">
                                            <li>
                                                    <a href="" data-toggle="modal" data-target="#addUser">
                                                        <em class="fas fa-user-plus"></em> Add User
                                                    </a>
                                                  
                                            </li>
                                            <li class="divider"></li>
											<li>
                                                <form action="{{ route('downloadUserCsv') }}" method="POST" id="downloadUserCsv">
                                                    @csrf
                                                    <a href="javascript:{}" onclick="document.getElementById('downloadUserCsv').submit();">
                                                        <em class="fas fa-file-download"></em> Download CSV
                                                    </a>
                                                </form>    
                                            </li>
											<li class="divider"></li>
											<li>
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <a href="#" data-toggle="modal" data-target="#uploadModal">
												    <em class="fas fa-file-upload"></em> Upload CSV
											    </a>    
                                            </form>                                   
                                            </li>
                                            <li class="divider"></li>
                                            <li><a href="#" data-toggle="modal" data-target="#pictureModal">
												    <em class="fas fa-file-upload"></em> Upload Pictures
											    </a>   </li>
                                            
                                                <li class="divider"></li>
                                            <li>
                                                    <a href="" data-toggle="modal" data-target="#tokenModal">
                                                        <em class="fas fa-user-plus"></em> Register Tokens
                                                    </a>
                                                  
                                            </li>	
										</ul>
                                       
									</li>
								</ul>
							</li>
						</ul>
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fas fa-caret-down"></em></span></div>
					<div class="panel-body articles-container">
                        <table class="table" id="booksTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ strtoupper($user->first_name) }} {{ strtoupper($user->middle_name) }} {{ strtoupper($user->last_name) }} {{ strtoupper($user->extension) }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    To do<span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <form action="{{ route('admin.viewUser') }}" method="GET" id="viewUser{{$user->id}}" style="margin-left: 3%;">
                                                             @csrf
                                                            <input type="hidden" value="{{ $user->id }}" name="user_id">
                                                            <i class="fas fa-search"></i><a href="javascript:{}" onclick="document.getElementById('viewUser{{$user->id}}').submit();" style="color: black;"> &nbspView</a>
                                                        </form>  
                                                    </li>
                                                    <li> 
                                                        <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" id="delete{{$user->id}}" style="margin-left: 3%;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" value="{{ $user->id }}" name="book_id">
                                                                <i class="fas fa-trash"></i><a href="javascript:{}" onclick="document.getElementById('delete{{$user->id}}').submit();" style="color: black;"> &nbsp Delete</a>
                                                            </form>  
                                                        </li>
                                                       
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>                     
                                </tr>                                   
                            @endforeach
                            </tbody>
                        </table>
                    </div>
			</div><!--/.col-->
			
	<!-- Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Upload a File</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('uploadUserCsv') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="importCsv">Select CSV File to Import</label><br>
                <input type="file" name="importCsv" id="importCsv" classs="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit"><i class="fa fa-upload"></i>
                    Import
                
                </button>
            </div>
        </form> 
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add User</h4>
      </div>
      <div class="modal-body">
        
        <form action="{{ route('admin.addUser') }}" method="POST">
            @csrf
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" name="first_name" id="first_name">
            <label for="middle_name">Middle Name</label>
            <input type="text" class="form-control" name="middle_name" id="middle_name">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" name="last_name" id="last_name">
            <label for="extension">Extension Name</label>
            <input type="text" class="form-control" name="extension" id="extension">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email">
            <br><br>
            <button class="btn btn-success form-control">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="pictureModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Upload a File</h4>
      </div>
      <div class="modal-body">
        
            <form action="{{ route('admin.image') }}" class="dropzone" id="my-awesome-dropzone" method="POST">
              @csrf

            </form>

       
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="tokenModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Generate Register Tokens</h4>
      </div>
      <div class="modal-body">
        
            <form action="{{ route('admin.token') }}" method="POST">
              @csrf
              <label for="tokens">Amount to Generate</label>
               <input type="number" id="tokens" name="tokens" class="form-control">     
               <br><br>
               <button class="btn btn-success form-control">Generate</button>                                    
            </form>

       
      </div>
    </div>
  </div>
</div>




@endsection

@section('customScript')
<script>
    $(document).ready( function () {
        $('#booksTable').DataTable();
        $('.delete').on('click', function () {
        return confirm('Are you sure you want to delete this user?');
    });
    } );
    $('#myModal').on('shown.bs.modal', function () {
     $('#myInput').focus()
    });


</script>

@endsection
@section('customScript')
<script>
    $(document).ready( function () {
        Dropzone.options.dropzone =
         {
            maxFilesize: 7,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 5000,
            success: function(file, response) 
            {
                console.log(response);
            },
            error: function(file, response)
            {
               return false;
            }
        };
    });


</script>

@endsection