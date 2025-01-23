<?php
    require_once '../model/userModel.php';
    require_once ('../model/userModel.php');

    function submitFeedback($requestData) {
        // Validate input data
        if (isset($requestData['user_id'], $requestData['satisfaction'], 
                $requestData['recommend'], $requestData['improvements'], $requestData['rating'])) {

            // Use user_id directly from the request as feedbacker_id
            $feedbacker_id = $requestData['user_id'];

            $feedbackData = [
                'feedbacker_id' => $feedbacker_id,
                'satisfaction'  => $requestData['satisfaction'],
                'recommend'     => $requestData['recommend'],
                'improvements'  => $requestData['improvements'],
                'rating'        => $requestData['rating']
            ];

            // Insert data into the database
            $isInserted = insertFeedback($feedbackData);

            if ($isInserted) {
                return "Feedback submitted successfully!";
            } 
            else {
                return "Failed to submit feedback. Please try again.";
            }
        } else {
            return "Invalid input data.";
        }
    }
?>
