<!DOCTYPE html>
<html>
<head>
    <title>Add/remove multiple input fields dynamically with Jquery Laravel 5.8</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
<div class="container">
    <h2 align="center">Add/remove multiple input fields dynamically with Jquery Laravel 5.8</h2> 
    {{-- view --}}
    <table class="table table-bordered" id="dynamicTable">  
        <tr>
            <th>Name</th>
            <th>Qty</th>
            <th>Price</th>            
        </tr>
        @foreach($stok as $s)
        <tr>  
            <td>{{$s->name}}</td>  
            <td>{{$s->qty}}</td>  
            {{-- <td>@foreach(json_decode($s->price) as $prc) {{$prc}}, @endforeach</td>               --}}
        <td><ul>@foreach(json_decode($s->price) as $prc) <li><a target="blank" href="{{ asset('file/'.$prc) }}">{{$prc}}</a></li> @endforeach</ul></td>
        </tr>  
        @endforeach
    </table> 

    {{-- insert --}}
    <form action="{{ route('addmorePost') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif
        <input type="text" name="name" placeholder="Enter your Name" class="form-control" />
        <input type="text" name="qty" placeholder="Enter your Qty" class="form-control" />
        <input type="file" name="price[]" class="form-control" />
        <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
        <div id="dynamic">
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
<script type="text/javascript">
    var i = 0;
    $("#add").click(function(){
        ++i;
        $("#dynamic").append('<rmv><input type="file" name="price[]" class="form-control" /><button type="button" class="btn btn-danger remove">Remove</button><rmv>');
    });
    $(document).on('click', '.remove', function(){  
         $(this).parents('rmv').remove();
    });
</script>
</body>
</html>