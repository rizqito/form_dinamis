<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel 5.8 - DataTables Server Side Processing using Ajax</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </head>
 <body>
  <div class="container">    
     <br />
     <h3 align="center">Dynamically Add / Remove input fields in Laravel 5.8 using Ajax jQuery</h3>
     <br />
    <form class="form form-horizontal" id="formSave" method="post" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="col-12">
        <div class="form-group row">
            <div class="col-md-3">
                <span>Nama</span>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-10">
                        <input type="text" id="file" class="form-control" name="firstname">
                        <div class="invalid-feedback"></div>
                    </div>                                               
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group row">
            <div class="col-md-3">
                <span>File Skripsi</span>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-10">
                        <input type="file" id="file" class="form-control" name="file[]">
                        <p>File harus .pdf atau .docx dan maksimal 3 MB</p>
                        <div class="invalid-feedback"></div>
                    </div>                                                 
                    <div class="col-md-2">
                        <button type="button" id="add" class="btn btn-info">add</button>
                    </div>                                                                   
                </div>
                <div id="dynamic"></div>
            </div>
        </div>
    </div>
    </form>
  </div>
 </body>
</html>

<script>
$(document).ready(function(){

    var i = 0;
    $("#add").click(function(){
        ++i;
        $("#dynamic").append(`
        <rmv>
            <div class="row">
            <div class="col-md-10">
                <input type="file" id="file" class="form-control" name="file[]">
                <p>File harus .pdf atau .docx dan maksimal 3 MB</p>
                <div class="invalid-feedback"></div>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove"><span class="feather icon-minus"></span></button>
            </div>
            </div>
        <rmv>`);
    });
    $(document).on('click', '.remove', function(){  
            $(this).parents('rmv').remove();
    });
// -------------------------------------
 var count = 1;

 dynamic_field(count);

 function dynamic_field(number)
 {
  html = '<tr>';
        html += '<td><input type="text" name="first_name[]" class="form-control" /></td>';
        html += '<td><input type="text" name="last_name[]" class="form-control" /></td>';
        if(number > 1)
        {
            html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
            $('tbody').append(html);
        }
        else
        {   
            html += '<td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
            $('tbody').html(html);
        }
 }

 $(document).on('click', '#add', function(){
  count++;
  dynamic_field(count);
 });

 $(document).on('click', '.remove', function(){
  count--;
  $(this).closest("tr").remove();
 });

 $('#dynamic_form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url:'{{ route("dinamis.insert") }}',
            method:'post',
            data:$(this).serialize(),
            dataType:'json',
            beforeSend:function(){
                $('#save').attr('disabled','disabled');
            },
            success:function(data)
            {
                if(data.error)
                {
                    var error_html = '';
                    for(var count = 0; count < data.error.length; count++)
                    {
                        error_html += '<p>'+data.error[count]+'</p>';
                    }
                    $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
                }
                else
                {
                    dynamic_field(1);
                    $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
                }
                $('#save').attr('disabled', false);
            }
        })
 });

});
</script>
