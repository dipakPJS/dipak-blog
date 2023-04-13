<?php require '../includes/autoload.inc.php'; ?>
<?php include '../templates/navbar.php'; ?>


<?php $fullPost = new DatabasePost();

if (isset($_GET['post_id'])) {
    $id = $_GET['post_id'];

    foreach ((array) $fullPost->showFullPost($id) as $posts) { ?> 
    
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('images/<?php echo $posts['img']; ?>')">
    <div class="container position-relative px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
    <div class="col-md-10 col-lg-8 col-xl-7">
    <div class="post-heading">
    <h1><?php echo $posts['title']; ?></h1>

    <h2 class="subheading"><?php echo $posts['subtitle']; ?></h2>

        <span class="meta">
        Posted by
        <a href="#!"><?php echo $posts['user_name']; ?></a>
        on <?php echo date('M', strtotime($posts['created_at'])).','.date('D', strtotime($posts['created_at'])).','
    .date('Y', strtotime($posts['created_at'])); ?>
        </span>
            </div>
            </div>
            </div>
            </div>



        </header>
        <!-- Post Content-->
        <article class="mb-4">
        <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
        <p>
        <?php echo $posts['body']; ?>
        </p>
<!-- <p>
Placeholder text by
<a href="http://spaceipsum.com/">Space Ipsum</a>
&middot; Images by
<a href="https://www.flickr.com/photos/nasacommons/">NASA on The Commons</a>
</p> -->

    <?php if (isset($_SESSION['username']) && $_SESSION['user_id'] == $posts['user_id']) { ?>

    <a href="http://localhost/clean-blog/posts/delete.php?delete_id=<?php echo $posts['id']; ?>"
    class=" btn btn-danger text-center float-end">DELETE</a>
    <a href="update.php?update_id=<?php echo $posts['id']; ?>" class=" btn btn-warning text-center">UPDATE</a>

    <?php } ?>
    </div>
    </div>
    </div> 
    </article> 
    <?php
    }
} else {
    header('location: http://localhost/clean-blog/404.php');
}

?>
 
        <?php require '../templates/footer.php'; ?>