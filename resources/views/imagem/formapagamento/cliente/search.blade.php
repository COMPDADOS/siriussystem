<html>

    <head>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" rel="stylesheet" />
    </head>

    <body>

        <select class="js-data-example-ajax"></select>
    </body>

    <script>



        $('.js-data-example-ajax').select2
        ({
            ajax: 
            {
                minimumInputLength: 3,
                url: 'https://api.github.com/search/repositories',
                dataType: 'json',
            }
        });
        src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"
    </script>
  }
});

</html>

