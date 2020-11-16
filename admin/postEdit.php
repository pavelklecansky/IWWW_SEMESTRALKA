<?php require_once "../includes/config.php";

if (!$user->isLogged()) {
    header("location: ./login.php");
    exit();
}
$errorMessage = "";
if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error == "emptyinput") {
        $errorMessage = "Prázdný vstup";
    }
}
if (isset($_POST['submit'])) {
    extract($_POST);
    $postId = $_GET["id"];
    if (ValidationUtils::isEmpty($title) || ValidationUtils::isEmpty($content) ||
        ValidationUtils::isEmpty($date) || ValidationUtils::isEmpty($published) ||
        ValidationUtils::isEmpty($author) || ValidationUtils::isEmpty($category) || ValidationUtils::isEmpty($description)) {
        header("location: ./postEdit.php?id=$postId&error=emptyinput");
        exit();
    }
    $published = $published == "on" ? 1 : 0;

    PostRepository::updatePost($_GET["id"], $title, $content, $date, $published, $category,$description);
    TagRepository::deleteAllTagByPostID($_GET["id"]);
    foreach ($tagIds as $tag_id) {
        TagRepository::addTagToPost($_GET["id"], $tag_id);
    }

    header("location: ./index.php");
    exit();
}
$row = PostRepository::getPostById($_GET["id"]);
if (!isset($row)) {
    header("location: ./users.php");
    exit();
}

$allTags = TagRepository::getTagByPostId($_GET["id"]);
$allTagsIds = [];
foreach ($allTags as $item) {
    array_push($allTagsIds, $item["tag_id"]);
}

extract($row);

?>
<?php require_once "./template/header.php" ?>


<section id="layout">
    <?php require_once "./template/navigation.php" ?>
    <article class="content">
        <form action="./postEdit.php?id=<?php echo $_GET["id"]; ?>" method="post" class="pure-form pure-form-stacked">
            <fieldset>
                <legend>Upravit článek</legend>
                <label for="title">Titulek</label>
                <input type="text" id="title" name="title" placeholder="Titulek" required
                       value="<?php echo $title; ?>"/>
                <label for="date">Datum</label>
                <input type="date" id="date" name="date" required/>
                <label for="description">Popis</label>
                <textarea cols="50" id="description" name="description"
                          placeholder="Popis"><?php echo $description; ?></textarea>
                <label for="content">Obsah</label>
                <textarea class="form-control" rows="3" id="content" name="content"></textarea>
                <label for="category">Kategorie</label>
                <select name="category" id="category">
                    <?php
                    foreach (CategoryRepository::getAll() as $category) {
                        extract($category);
                        if ($category_category_id == $category_id) {
                            echo "<option value='$category_id' selected>$title</option>";
                        } else {
                            echo "<option value='$category_id'>$title</option>";
                        }
                    } ?>
                </select>

                <article class="tags">
                    <p>Tagy</p>
                    <fieldset>
                        <?php
                        foreach (TagRepository::getAll() as $tag) {
                            extract($tag);
                            if (in_array($tag_id, $allTagsIds)) {
                                echo "<label for='tagIds[]'>$title ";
                                echo "<input checked type='checkbox' id='$slug' name='tagIds[]' value='$tag_id' placeholder='$title'/></label>";

                            } else {
                                echo "<label for='tagIds[]'>$title ";
                                echo "<input type='checkbox' id='$slug' name='tagIds[]' value='$tag_id' placeholder='$title'/></label>";

                            }
                        }
                        ?>
                    </fieldset>
                </article>

                <label for="published">Publikovat
                    <?php
                    if ($published) {
                        echo ' <input type="checkbox" id="published" name="published" placeholder="Publikovat" checked/>';
                    } else {
                        echo ' <input type="checkbox" id="published" name="published" placeholder="Publikovat"/>';
                    }
                    ?>

                </label>

                <input type="submit" name="submit" class="pure-button pure-button-primary" value="Upravit článek"/>
                <?php
                if ($errorMessage != "") {
                    echo '<div class="bar error">';
                    echo $errorMessage;
                    echo '</div>';
                }
                ?>
            </fieldset>
        </form>

    </article>
</section>

<link rel="stylesheet" href="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<script src="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

<script>
    var simplemde = new SimpleMDE({
        element: document.getElementById("content")
    });
    simplemde.value(`<?php echo $content; ?>`);
    document.querySelector("#date").valueAsDate = new Date("<?php echo $date; ?>");

</script>

<?php require_once "./template/footer.php" ?>

