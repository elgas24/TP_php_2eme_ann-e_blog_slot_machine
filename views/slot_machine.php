<?php
$headtitle = "Update des articles";

// if(!isset($article)||!$article){
//     $myArray = ["a"=>"red","b"=>"green","c"=>"blue","d"=>"yellow","e"=>"purple"];

// $value = shuffle($myArray);
// print_r($myArray);

// randomise plus shuffle 
ob_start();
?>
<section class="main-sections">
    <article class="main-articles">
        <h1 class="main-articles-title">
            <?= $headtitle ?>
        </h1>
        <form action="/slot"  method="POST">
        <label for="content">Content:</label>
            <textarea id="content" name="content"
                placeholder="Content of your article" required ><?php echo $myArray[0]?>
            </textarea>

            <label for="content">Content:</label>
            <textarea id="content" name="content"
                placeholder="Content of your article" required ><?php echo $myArray[1]?>
            </textarea>

                <label for="content">Content:</label>
            <textarea id="content" name="content"
                placeholder="Content of your article" required ><?php echo $myArray[3]?>
            </textarea>

            <button type="submit">Spin</button>
        </form>
</section>
<?php
$mainContent = ob_get_clean();