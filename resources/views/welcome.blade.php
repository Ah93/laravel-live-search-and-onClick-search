<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel Typeahead JS Autocomplete Search</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" />
    <style>
         @import url("https://fonts.googleapis.com/css2?family=Poppins:weight@100;200;300;400;500;600;700;800&display=swap");

body {
    background-color: #eee;
    font-family: "Poppins", sans-serif;
    font-weight: 300
}

.height {
    height: 60vh
}

.search {
    position: relative;
    box-shadow: 0 0 40px rgba(51, 51, 51, .1)
}

.search input {
    height: 60px;
    text-indent: 25px;
    border: 2px solid #d6d4d4
}

.search input:focus {
    box-shadow: none;
    border: 2px solid blue
}

.search .fa-search {
    position: absolute;
    top: 20px;
    left: 16px
}

.search button {
    position: absolute;
    top: 5px;
    right: 5px;
    height: 50px;
    width: 110px;
    background: blue
}
    </style>
</head>



<body id="stop-scrolling">
<div class="preloader"></div>
    <!-- Search Box -->
<div class="container">
    <div class="row height d-flex justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="search"> 
				<i class="fa fa-search"></i> 
				<input type="text" id="search" name="search" class="form-control" placeholder="Search for Used Cars"> 
				<button class="btn btn-primary" id="btn-search">Search</button> 
			</div>
        </div>
    </div>

    <div id="carTablek">
    <table id="carTable" class='table table-inverse'>
         <thead>
              <tr>
                <th>S.no</th>
                <th>name</th>
                <th>mileage</th>
                <th>dealer_name</th>
                <th>rating</th>
                <th>rating_count</th>
                <th>price</th>
                </tr>
            </thead>
            <tbody></tbody>
</table>
    </div>
</div>
 <!-- End -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    <script type="text/javascript">
        var route = "{{ url('autocomplete-search') }}";

        $('#search').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
    </script>

<script type="text/javascript">
        var route = "{{ url('autocomplete-search') }}";

        $('#search').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
    </script>

<script type='text/javascript'>
$(document).ready(function(){

    $('#btn-search').click(function(){
    var name = $('#search').val();

    $.ajax({
        type:"GET",
        url: 'fetchCarRecord',
        data: {name: $('#search').val()},
        success: function(response) {
            $('#carTable tbody').empty(); // Empty <tbody>
            var len = 0;
            len = response['data'].length;
           if(len > 0){
              for(var i=0; i<len; i++){
                 var id = response['data'][i].id;
                 var name = response['data'][i].name;
                 var mileage = response['data'][i].mileage;
                 var dealer_name = response['data'][i].dealer_name;
                 var rating = response['data'][i].rating;
                 var rating_count = response['data'][i].rating_count;
                 var price = response['data'][i].price;
      
        var tr_str = "<tr>" +
             "<td align='center'>" + id + "</td>" +
             "<td align='center'>" + name + "</td>" +
             "<td align='center'>" + mileage + "</td>" +
             "<td align='center'>" + dealer_name + "</td>" +
             "<td align='center'>" + rating + "</td>" +
             "<td align='center'>" + rating_count + "</td>" +
             "<td align='center'>" + price + "</td>" +
           "</tr>" +
        "</table>";
        $("#carTable tbody").append(tr_str);
              }
           }else{      
            var tr_str =  "<tr>" +
                  "<td align='center' colspan='4'>No record found.</td>" +
              "</tr>";
              $("#carTable tbody").append(tr_str);
           }
            
         }



    });


});

});
     </script>

</body>

</html>