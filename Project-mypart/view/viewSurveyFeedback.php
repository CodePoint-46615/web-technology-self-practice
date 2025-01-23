<?php
    session_start(); 
    require_once ('../controller/FeedbackController.php');

    // Redirect to login if the user is not logged in
    if (!isset($_COOKIE['status'])) {
        header('location: login.php');
        exit;
    }

    // Use 'id' from request or session
    if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
        $userId = $_REQUEST['id'];
    } elseif (isset($_SESSION['id'])) {
        $userId = $_SESSION['id'];
    } else {
        echo "Error: User ID is missing!";
        exit;
    }

    // Retrieve the user details
    $user = getUser($userId);
    if (!$user) {
        echo "Error: User not found!";
        exit;
    }

    // Fetch all blogs from the database
    $blogs = getAllBlog();

    $_SESSION['update_id'] = $userId;

    // Retrieve feedback message if it exists
    $message = '';
    if (isset($_SESSION['feedback_message'])) {
        $message = $_SESSION['feedback_message'];
        unset($_SESSION['feedback_message']); // Clear after displaying
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the feedback
    $message = submitFeedback($_POST);

    // Store the message in the session and redirect
    $_SESSION['feedback_message'] = $message;
    header('Location: viewSurveyFeedback.php?id=' . $userId); 
    exit;  // Ensure the script stops after redirection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Feedback</title>
    <link rel="stylesheet" href="../asset/CSS/viewSurveyFeedback.css">
</head>
<body>
    <?php if ($message): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <form action="viewSurveyFeedback.php" method="post">
        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($userId); ?>">
        <fieldset>
            <legend>Survey Feedback</legend>

            <fieldset>
                <legend>Survey Questions</legend>
                <label for="satisfaction">How satisfied are you with our service?</label><br>
                <input type="radio" id="satisfied" name="satisfaction" value="satisfied" required>
                <label for="satisfied">Satisfied</label><br>
                <input type="radio" id="neutral" name="satisfaction" value="neutral" required>
                <label for="neutral">Neutral</label><br>
                <input type="radio" id="dissatisfied" name="satisfaction" value="dissatisfied" required>
                <label for="dissatisfied">Dissatisfied</label><br><br>

                <label for="recommend">Would you recommend our service to others?</label><br>
                <input type="radio" id="yes" name="recommend" value="yes" required>
                <label for="yes">Yes</label><br>
                <input type="radio" id="no" name="recommend" value="no" required>
                <label for="no">No</label><br><br>

                <label for="improvements">What areas do you think we could improve?</label><br>
                <textarea id="improvements" name="improvements" rows="4" cols="50" required></textarea><br><br>
            </fieldset>

            <fieldset>
                <legend>Rating</legend>
                <label for="rating">Rate our service (1 to 5):</label><br>
                <input type="number" id="rating" name="rating" min="1" max="5" required><br><br>
            </fieldset>
            <button type="submit">Submit Feedback</button><br><br>
            <a href="viewProfile.php">Go to Profile</a>
        </fieldset>
    </form>
</body>
</html>
