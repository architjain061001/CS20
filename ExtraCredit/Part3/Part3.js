$(document).ready(function() {
    var images = ['images/car1.jpeg', 'images/car2.jpeg', 'images/car3.jpeg', 'images/car4.webp', 'images/car5.jpeg'];
    var currentIndex = 0;
    var timeoutId;
    
    function showImage(index) {
        $('#image-slider img').eq(index).addClass('active').css('opacity', 0);
        $('#image-slider img.active').animate({ opacity: 1 }, 500, function() {
          timeoutId = setTimeout(function() {
            $('#image-slider img.active').animate({ opacity: 0 }, 500, function() {
              $('#image-slider img.active').removeClass('active');
              currentIndex = (currentIndex + 1) % images.length;
              showImage(currentIndex);
            });
          }, 1500);
        });
      }
        
        $('#start').click(function() {
            showImage(currentIndex);
        });
        
        $('#stop').click(function() {
            clearTimeout(timeoutId);
        });
});