    <script src="https://kit.fontawesome.com/d6057c0063.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/app.js"></script>
    
    <script>
        $(".alert").delay(1500).slideUp(200, function() {
            $(this).alert('close');
        });
    </script>
    <script>
        var sidebar_nav = document.getElementById('sidebar_nav');
       var myScrollFunc = function() {
            var y = window.scrollY;
            if (y >= 60) {
                sidebar_nav.className="sidebar_nav show"
            } else {
                sidebar_nav.className="sidebar_nav hide"
            }
        };

        window.addEventListener("scroll", myScrollFunc);
    </script>
</body>
</html>