<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $("p").click(function(){
                    $(this).hide();
                    //$(".b").hide();
                });
            });
            function showdiv()
            {
                $("p").show();
            }
        </script>
    </head>
    <body>
        <p class="a"> This is a Paragraph </p>
        <p class="b"> This is another Paragraph </p>
        <p class="c"> This is third Paragraph </p>
        <p class="d"> This is fourth Paragraph </p>
        <p class="e"> This is fifth Paragraph </p>
        <p class="f"> This is sixth Paragraph </p>

        <a href="javascript:void(0)" onclick="showdiv()">Show</a>
    </body>
</html>