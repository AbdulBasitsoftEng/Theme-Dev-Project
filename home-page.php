<?php
/*
  Template Name: Home Template

 */
 
get_header();
?>

<div class="container">


<div class="row">
<div class="col-12 bg-light py-3"><h1 class="text-center py-3"><?php the_title(); ?></h1></div>
</div>

    <div class="row my-3">

    <div class="col-lg-6 col-md-6 col-12 d-flex justify-content-center align-items-center">

   <div>
   <h1>Welcome To Our Compnay</h1>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
   Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
   when an unknown printer took a galley of type and scrambled it to make a type specimen book.
    It has survived not only five centuries, but also the leap into electronic typesetting, 
    remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
     sheets containing Lorem Ipsum passages, and more recently with desktop publishing software 
     like Aldus PageMaker including versions of Lorem Ipsum.</p>


<button type="button" class="btn btn-secondary">More About Us</button>
<button type="button" class="btn btn-success">Let's Connect</button>

   </div>


</div>

<div class="col-lg-6 col-md-6 col-12">

<img src="http://localhost/custom/wp-content/uploads/2024/10/796-536x354-1.jpg" class="img-fluid">

</div>
</div>
</div>



<!-- Adding Projetcs Section -->
<section class="bg-light my-3 py-3">
  <h2 class="text-center py-2">OUR PROJECTS</h2>
<?php
get_template_part('Template-parts/projects-loop');
?>
</section>


<section class="my-3 py-3">
  <h2 class="text-center py-2">OUR BLOGS</h2>
<?php
get_template_part('Template-parts/post-loop');
?>
</section>

<?php get_footer(); ?>