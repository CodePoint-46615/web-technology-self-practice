<?php
    //Database connection
    function getConnection(){
        $con = mysqli_connect('127.0.0.1', 'root', '', 'agripro');
        return $con;
    }

    //check Duplicate Email
    function checkDuplicateEmail($email) {
        $con = getConnection();
        // SQL query to check if email already exists
        $sql = "SELECT COUNT(*) FROM user WHERE email = '{$email}'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($result);
        
        // If the email exists, return true, otherwise false
        return $row[0] > 0;
    }

    //check Duplicate Phone
    function checkDuplicatePhone($phone) {
        $con = getConnection();
        // SQL query to check if email already exists
        $sql = "SELECT COUNT(*) FROM user WHERE phone = '{$phone}'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($result);
        
        // If the email exists, return true, otherwise false
        return $row[0] > 0;
    }

    //ADD user to the system
    function addUser($username, $email, $phone, $gender, $dob, $image, $password, $utype) {
        $con = getConnection();
        if (checkDuplicateEmail($email)|| checkDuplicatePhone($phone)) {
            return false; // If email is duplicate, return false
        }
        else{
            $sql = "INSERT INTO user (username, email, phone, gender, dob, image, password, utype) 
            VALUES ('{$username}', '{$email}', '{$phone}', '{$gender}', '{$dob}', '{$image}', '{$password}', '{$utype}')";
            if (mysqli_query($con, $sql)) {
                return true;
            } else {
                return false;
            }
        }
    }

    //login
    function login($email, $password){
        $con = getConnection();
        $sql = "select * from user where email='{$email}' and password='{$password}'";
        $result = mysqli_query($con, $sql);
        $count = mysqli_num_rows($result);

        if($count ==1){
            return true;
        }else{
            return false;
        }
    }

    //get all user 
    function getAllUser(){
        $con = getConnection();
        $sql = "select * from user";
        $result = mysqli_query($con, $sql);
        $users = [];

        while($row = mysqli_fetch_assoc($result)){
            array_push($users, $row);
        }  
        return $users;
    }

    //get user by id
    function getUser($id){
        $con = getConnection();
        $sql = "select * from user where id='{$id}'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    //get user by mail
    function getUserByEmail($email) {
        $con = getConnection();
        $sql = "SELECT * FROM user WHERE email='{$email}'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
    

    //Edit Profile
    function editProfile($id, $name, $email, $phone, $gender, $dob){
        $con = getConnection();
        $sql = "UPDATE user 
                SET username='$name', email='$email', phone='$phone', gender='$gender', dob='$dob' 
                WHERE id='$id'";
        if(mysqli_query($con, $sql)){
            return true;
        } 
        else {
            return false;
        }
    }

    //verify pass
    function verifyPassword($id, $oldpass) {
        $con = getConnection();
        $id = mysqli_real_escape_string($con, $id);
        $old_password = mysqli_real_escape_string($con, $oldpass);
        $sql = "SELECT * FROM user WHERE id = '$id' AND password = '$oldpass'";
        $result = mysqli_query($con, $sql);
    
        if (mysqli_num_rows($result) > 0) {
            return true; // Password matches
        } else {
            return false; // Password does not match
        }
    }
    

    //update pass
    function editPassword($id, $password){
        $con = getConnection();
        $sql = "UPDATE user SET password='$password' WHERE id='$id'";
        if(mysqli_query($con, $sql)){
            return true;
        } 
        else {
            return false;
        }
    }

    function updateImage($id, $image) {
        $con = getConnection(); 
        $stmt = $con->prepare("UPDATE user SET image = ? WHERE id = ?");
        $stmt->bind_param("si", $image, $id);
        $status = $stmt->execute();
        $stmt->close();
        return $status;
    }

    //search user
    function searchUsers($query) {
        $con = getConnection();
        
        // Use prepared statements to prevent SQL injection
        $sql = "
            SELECT * 
            FROM user 
            WHERE username LIKE ? 
            OR email LIKE ? 
            OR phone LIKE ? 
            OR id LIKE ?
        ";
        $stmt = mysqli_prepare($con, $sql);
        
        $likeQuery = "%{$query}%";
        mysqli_stmt_bind_param($stmt, 'ssss', $likeQuery, $likeQuery, $likeQuery, $likeQuery);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        $users = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
        
        return $users;
    }

    // Fetch all user when no search query is provided
    function fetchAllUser() {
        $con = getConnection();
        $sql = "SELECT * FROM user";
        $result = mysqli_query($con, $sql);

        $users = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $users[] = $row;
            }
        }
        return $users;
    }

    // function insertBlog($author_id, $title, $content) {
    //     $summary = substr($content, 0, 100);
    //     $sql = "INSERT INTO blogs (author_id, title, content, summary, created_at) VALUES (?, ?, ?, ?, NOW())";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bind_param('isss', $author_id, $title, $content, $summary);
    //     if ($stmt->execute()) {
    //         return true;
    //     } else {
    //         return $stmt->error;
    //     }
    // }
    
    // Insert blog into the database
    function insertBlog($author_id, $title, $content) {
        $con = getConnection(); // Get database connection
        $summary = substr($content, 0, 100); // Generate summary
        
        $sql = "INSERT INTO blogs (author_id, title, content, summary, created_at) 
                VALUES ('{$author_id}', '{$title}', '{$content}', '{$summary}', NOW())";

        if (mysqli_query($con, $sql)) {
            return true; // Successfully inserted
        } else {
            return mysqli_error($con); // Return the error message
        }
    }

    //search blog
    function searchBlog($query) {
        $con = getConnection();
        
        // Use prepared statements to prevent SQL injection
        $sql = "
            SELECT 
                b.id,
                b.title,
                b.content,
                b.summary,
                b.created_at,
                b.updated_at,
                u.username AS author_name
            FROM blogs b
            JOIN user u ON b.author_id = u.id
            WHERE b.title LIKE ? 
            OR b.content LIKE ? 
            OR b.summary LIKE ?
        ";
        $stmt = mysqli_prepare($con, $sql);
        
        $likeQuery = "%{$query}%";
        mysqli_stmt_bind_param($stmt, 'sss', $likeQuery, $likeQuery, $likeQuery);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        $blogs = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $blogs[] = $row;
        }
        
        return $blogs;
    }
    

    //get all blog 
    function getAllBlog() {
        $con = getConnection();
        $sql = "
            SELECT 
                b.id,
                b.title,
                b.content,
                b.summary,
                b.created_at,
                b.updated_at,
                u.username AS author_name
            FROM blogs b
            JOIN user u ON b.author_id = u.id
        ";
        $result = mysqli_query($con, $sql);
    
        $blogs = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $blogs[] = $row;
        }
        return $blogs;
    }

    //Insert feedback to database
    function insertFeedback($data) {
        $db = getConnection(); // Use the getConnection() function from userModel.php
        
        $query = "INSERT INTO survey_feedback 
                  (survay_feedbacker_id, satisfaction, recommend, improvements, rating) 
                  VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $db->prepare($query);
        
        // Bind parameters using positional placeholders
        $stmt->bind_param(
            "isssi", // Types: i = integer, s = string
            $data['feedbacker_id'],
            $data['satisfaction'],
            $data['recommend'],
            $data['improvements'],
            $data['rating']
        );
        
        // Execute the statement
        return $stmt->execute();
    }

    function getAllSurvey() {
        $con = getConnection();
        $sql = "
            SELECT 
                sfb.feedback_id,
                sfb.satisfaction,
                sfb.recommend,
                sfb.improvements,
                sfb.rating,
                sfb.submitted_at
            FROM survey_feedback sfb
            JOIN user u ON sfb.survay_feedbacker_id = u.id
        ";
        $result = mysqli_query($con, $sql);
    
        $blogs = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $blogs[] = $row;
        }
        return $blogs;
    }
    
    
?>