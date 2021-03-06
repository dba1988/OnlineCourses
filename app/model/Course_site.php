<?php


class Course_site
{
    protected $db;

    function __construct()
    {
        $this->db = new Model();
    }

// return all row of table of courses
    public function all()
    {
        return $this->db->query("select * from courses");
    }

    public function getCoursesById($id)
    {
        return $this->db->query("select * from courses where categories_ids like '%\"$id\"%'");
    }

    public function insertInToUsersCourses(array $aData)
    {
        $insertIntoUserCourses = $this->db->preparation('INSERT INTO `users_courses`( `user_id`,user_wish_list) 
                                 VALUES (:user_id ,:user_wish_list)');
        $insertIntoUserCourses->execute($aData);
        return $this->db->lastInsertId();
    }
    public function insertInToUsersBuyCourses(array $aData)
    {
        $insertIntoUserCourses = $this->db->preparation('INSERT INTO `users_courses`( `user_id`,couces_buy) 
                                 VALUES (:user_id ,:couces_buy)');
        $insertIntoUserCourses->execute($aData);
        return $this->db->lastInsertId();
    }
    public function wishListElements($wishListElements)
    {
        return $this->db->query("select * from courses where course_id in $wishListElements");
    }

    public function latestCoursesWebsite()
    {
        return $this->db->query("SELECT * FROM courses ORDER BY course_id DESC LIMIT 8");
    }

    public function userHasCourses($id)
    {
        $t = true;
        $course = $this->db->query("SELECT * FROM users_courses WHERE user_id=$id ");
        if (count($course) < 1)
            $t = false;
        return $t;
    }

    public function wishListCourseUser($id)
    {
        return $this->db->query("SELECT * FROM `users_courses` INNER JOIN courses on 
find_in_set(courses.course_id, replace(users_courses.user_wish_list, ';', ',')) WHERE users_courses.user_id=$id ");
    }

    public function wishListUser($id)
    {
//        return $this->db->query("select * from courses");
        return $this->db->query("SELECT `user_wish_list`, `couces_buy` FROM `users_courses` WHERE user_id=$id");
    }

    public function updateFromthewishlist($aData)
    {
        $insertIntoUserCourses = $this->db->preparation('UPDATE `users_courses` SET `user_wish_list`=:user_wish_list
                                                                WHERE user_id=:user_id');
        $insertIntoUserCourses->execute($aData);
        return $this->db->lastInsertId();

    }

    public function updateUserCourse($aData)
    {
        $insertIntoUserCourses = $this->db->preparation('UPDATE `users_courses` SET `couces_buy`=:couces_buy
                                                                WHERE user_id=:user_id');
        $insertIntoUserCourses->execute($aData);
        return $this->db->lastInsertId();

    }

}

?>