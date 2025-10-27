<?php
session_start();

// Database connection (you'll need to configure these values)
$dbConfig = [
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'db'   => 'portfolio'
];

// Connect to database
function connectDB() {
    global $dbConfig;
    try {
        $conn = new PDO(
            "mysql:host={$dbConfig['host']};dbname={$dbConfig['db']}",
            $dbConfig['user'],
            $dbConfig['pass']
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        return false;
    }
}

// Handle contact form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact'])) {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    
    if ($name && $email && $message) {
        $conn = connectDB();
        if ($conn) {
            try {
                $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
                $stmt->execute([$name, $email, $message]);
                $_SESSION['message'] = "Message sent successfully!";
                $_SESSION['message_type'] = "success";
            } catch(PDOException $e) {
                $_SESSION['message'] = "Error sending message.";
                $_SESSION['message_type'] = "error";
            }
        }
    }
    header('Location: #contact');
    exit;
}

// Get projects from database
function getProjects() {
    $conn = connectDB();
    if ($conn) {
        try {
            $stmt = $conn->query("SELECT * FROM projects ORDER BY id DESC LIMIT 3");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return [];
        }
    }
    return [];
}

// Get skills from database
function getSkills() {
    $conn = connectDB();
    if ($conn) {
        try {
            $stmt = $conn->query("SELECT * FROM skills ORDER BY id ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return [];
        }
    }
    return [];
}
?>

<!-- Flash Messages -->
<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['message_type']; ?>">
        <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
        ?>
    </div>
<?php endif; ?>