<?php

class LoginController extends Controller
{

    public function index()
    {
        // echo "LoginController index method called.<br>";  // Debug output
        View::render('login');
    }

    public function login()
    {
        // Check if the request is a POST request (login form submission)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle the login submission
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;

            // Check if email and password are provided
            if ($email && $password) {
                $userModel = new UserModel();
                $user = $userModel->findUserByEmail($email);

                // Validate the user and password
                if ($email === 'admin@admin.com' && password_verify($password, $user['password'])) {
                    $_SESSION['user_email'] = $email; // Set session for admin
                    header('Location: /hotel-reservation/public/index.php/admin');
                } elseif ($user && password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION['user_id'] = $user['id'];

                    // Redirect to the dashboard
                    header("Location: /hotel-reservation/public/index.php/dashboard1");
                    exit();
                } else {
                    echo "Invalid email or password!";
                }
            } else {
                echo "Please enter both email and password!";
            }
        } else {
            // If it's a GET request, render the login form
            View::render('login');
        }
    }

    public function register()
    {
        View::render('register');
    }

    public function store()
    {
        // Ensure capturing the form input fields
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;
        $passwordConfirm = $_POST['password_confirm'] ?? null;

        // Debug output to ensure variables are captured
        // echo "Email: $email<br>";
        // echo "Password: $password<br>";
        // echo "Password Confirm: $passwordConfirm<br>";

        // Validate password confirmation
        if ($password !== $passwordConfirm) {
            echo "Passwords do not match!";
            return;
        }

        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert the user into the database
        $userModel = new UserModel();

        // Check if the email is already registered
        if ($userModel->emailExists($email)) {
            echo "Email is already registered!";
            return;
        }

        // Create the user in the database
        $userModel->createUser($email, $hashedPassword);


        echo "User registered successfully!";

        header("Location: /hotel-reservation/public/index.php");
    }

    public function validateRegister($email, $password, $passwordConfirm)
    {
        $errors = [];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format!';
        }

        if (strlen($password) < 6) {
            $errors[] = 'Password is too weak!';
        }

        if ($password !== $passwordConfirm) {
            $errors[] = 'Password do not match!';
        }

        $userModel = new UserModel();
        if ($userModel->emailExists($email)) {
            $errors[] = 'Email already exist!';
        }

        return $errors;
    }

    public function logout()
    {
        // Start the session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Clear the session
        session_unset();
        session_destroy();

        // Redirect to the login page
        header("Location: /hotel-reservation/public/index.php/login");
        exit();
    }
}
