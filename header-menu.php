<script>
var num = 50; //number of pixels before modifying styles

$(window).bind('scroll', function () {
    if ($(window).scrollTop() > num) {
        $('.navbar').addClass('navbar-fixed-top');
    } else {
        $('.navbar').removeClass('navbar-fixed-top');
    }
});
</script>

<!-- nav -->
<div class="row">
<div class="container">
<nav class="navbar navbar-inverse">
<div class="container">
  <?php ck_nav(); ?>
</nav>
<div>
<div>
<!-- /nav -->