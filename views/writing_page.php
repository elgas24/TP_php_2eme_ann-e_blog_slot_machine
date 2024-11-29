<?php
$headtitle = "New article";

ob_start();

?>
<section>
    <h1>Ecris ton article</h1>
    <form action='/articles/add' method="POST">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" placeholder="Title of your article"
            value="<?php echo htmlspecialchars($title ?? ''); ?>">

        <label for="content">Content:</label>
        <textarea id="content" name="content"
            placeholder="Content of your article"><?php echo htmlspecialchars($content ?? ''); ?></textarea>

        <label for="author">Author:</label>
        <input type="text" id="author" name="author" placeholder="Author_name"
            value="<?php echo htmlspecialchars($author ?? ''); ?>">

        <button type="submit">Submit</button>
    </form>
</section>
<?php
$mainContent = ob_get_clean();
