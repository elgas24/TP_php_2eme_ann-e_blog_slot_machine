<?php
$headtitle = "Update des articles";

// if(!isset($article)||!$article){
if(empty($article)){
    header("Location:/418");
    exit;
} 

ob_start();
?>
<section class="main-sections">
    <article class="main-articles">
        <h1 class="main-articles-title">
            <?= $headtitle ?>
        </h1>
        <form   method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" placeholder="Title of your article"
                value="<?php echo htmlspecialchars(string: $article->title ?? ''); ?>">

            <label for="content">Content:</label>
            <textarea id="content" name="content"
                placeholder="Content of your article" required ><?php echo $article->content?></textarea>

            <label for="author">Author:</label>
            <input type="text" id="author" name="author" placeholder="Author_name"
                value="<?php echo htmlspecialchars($article->author ?? ''); ?>">

            <button type="submit">Modifier</button>
        </form>
</section>
<?php
$mainContent = ob_get_clean();