<?php

global $isSearch;
global $search;

if ($isSearch) {
?>
    <div class="posts">
        <?php
            // Получить посты по поисковому слову в комментариях
            $posts = $search->getPostsByWordToComments();
            if ($posts->num_rows > 0) {
                while ($post = $posts->fetch_object()) {
        ?>
            <div class="post border">
                <div class="post__title">
                    <span>
                        <?php print $post->id ?>.
                    </span>
                    <span>
                        <?php print $post->title ?>
                    </span>
                </div>
                <div class="post__comments">
                    <div class="comments_title">Комментарии:</div>
                    <?php
                        // Получить комментарии по поисковому слову в посте по id
                        $comments = $search->getCommentsToPost($post->id);
                        while ($comment = $comments->fetch_object()) {
                    ?>
                        <div class="comment border">
                            <span class="body">
                                <?php
                                    foreach ($comment as $key => $value) {
                                        print str_replace("$_POST[searchWord]",
                                            "<span class='search-word'>$_POST[searchWord]</span>", $value
                                        );
                                    }
                                ?>
                            </span>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php
                }
            } else include "./components/notSearch.php";
        ?>
    </div>
<?php
} else include "./components/notWord.php";
?>
