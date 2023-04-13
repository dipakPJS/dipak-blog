<?php require 'includes/autoload2.inc.php'; ?>
<?php require 'templates/navbar.php'; ?>
<?php require 'templates/header.php'; ?>
            
 <?php
$dataPost = new DatabasePost();

?>
 <div class="row gx-4 gx-lg-5 justify-content-center">
<div class="col-md-10 col-lg-8 col-xl-7">


<!-- Post preview-->
<?php foreach ((array) $dataPost->showPost() as $posts) { ?>  


<div class="post-preview">


<a href="http://localhost/clean-blog/posts/post.php?post_id=<?php echo $posts['id']; ?>">

<h2 class="post-title"><?php echo $posts['title']; ?></h2>
<h3 class="post-subtitle"><?php echo $posts['subtitle']; ?></h3>

</a>


<p class="post-meta">
Posted by
<a href="#!"><?php echo $posts['user_name']; ?></a>
on <?php echo date('M', strtotime($posts['created_at'])).','.date('D', strtotime($posts['created_at'])).','
.date('Y', strtotime($posts['created_at'])); ?>
</p>

</div>


<?php
} ?>
                    <!-- Divider-->
                    <hr class="my-4" />
                    
                    <!-- Pager-->
                    
                </div>
            </div>
       
            
<div class="row gx-4 gx-lg-5 justify-content-center">
    <h3 class="mb-4">categories</h3>
   

<?php
foreach ((array) $dataPost->showCategories() as $category) {
    ?>

 
    <div class="col-md-4 col-lg-4 col-xl-4">

    <a href="http://localhost/clean-blog/categories/category.php?category_id=<?php echo $category['id']; ?>">
    
    <div class="alert alert-dark bg-dark text-center text-white" role="alert">
 <?php echo $category['name']; ?>
</div>

</a>

    </div>
            <?php } ?>
</div>

            <?php require 'templates/footer.php'; ?>
            
            