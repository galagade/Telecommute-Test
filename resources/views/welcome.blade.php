<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css//bootstrap.min.css') }}" rel="stylesheet" />
        <!-- Styles -->
    </head>
    <body>
        <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Form</h2>
                <form action="#" id="addform" data-url="{{ url('post_products') }}">
                     <input type="hidden" class="form-control" id="uid">
                     <meta name="csrf-token" content="{{ csrf_token() }}" />


                  <div class="form-group">
                    <label for="productname">ProductName:</label>
                    <input type="text" class="form-control" id="productname">
                  </div>
                  <div class="form-group">
                    <label for="quantinty">Quantinty In Stock:</label>
                    <input type="number" class="form-control" id="quantinty" min="0">
                  </div>
                  <div class="form-group">
                    <label for="price">Price Per Item:</label>
                    <input type="number" class="form-control" id="price" min="0">
                  </div>
                  <button type="submit" class="btn btn-default " id="add">Submit</button>
                </form>
            </div>
            <div class="col-md-12">
                <h2>Table</h2>
                
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Product name</th>
                        <th>Quantity in stock</th>
                        <th>Price per item</th>
                        <th>Datetime submitted</th>
                        <th>Total value number</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="list_data" data-url="{{ url('gets_products') }}">
                    </tbody>
                  </table>
                
            </div>
        </div>
    </div>
        </div>
        <script src="{{ asset('js/jquery-1.12.0.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/script.js') }}" type="text/javascript"></script>
    </body>
</html>
