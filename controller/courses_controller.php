<?php
include 'model/courses_model.php';

function courses_index() {
    $data = get_all_courses();
    include 'view/courses_view.php';
}