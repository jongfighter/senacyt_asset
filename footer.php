
<footer class="page-footer teal">
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="brown-text text-lighten-3" href="https://kiv.nia.or.kr/">2016 World Friends ICT Volunteers from KOREA Team Vamos IT </a>
	  <div class="row right">
	  <a class="brown-text text-lighten-3" href="https://www.facebook.com/seiheesarakim">Sara</a>
	  <a class="brown-text text-lighten-3" href="https://www.facebook.com/ameliajungeunchoi">Amelia</a>
	  <a class="brown-text text-lighten-3" href="https://www.facebook.com/jongfighter">Juan</a>
	  <a class="brown-text text-lighten-3" href="https://www.facebook.com/YJH07">Terry</a>
	  </div>
	  </div>
    </div> 
</footer>

	<script>
	$(document)
	.ready(function(){
        // Add smooth scrolling to all links in navbar + footer link
        $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {
                // Prevent default anchor click behavior
                event.preventDefault();

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 900, function(){

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
            } // End if
        });

        $(window).scroll(function() {
            $(".slideanim").each(function(){
                var pos = $(this).offset().top;

                var winTop = $(window).scrollTop();
                if (pos < winTop + 600) {
                    $(this).addClass("slide");
                }
            });
        });
    })
	</script>