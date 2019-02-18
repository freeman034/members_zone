<?php
require('model/model.php');

$posts = getPosts();

require('view/listPostsView.php');
