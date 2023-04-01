<?php
// Define your functions here


  function validateEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return true;
    } else {
      return false;
    }
  }
  
  // Function to hash passwords
  function hashPassword($password) {
    $options = [
      'cost' => 12,
    ];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);
    return $hashed_password;
  }


  /**
 * Verify password against hash.
 *
 * @param string $password The plain text password to verify.
 * @param string $hash The hash to compare against.
 *
 * @return bool Returns true if password is verified, false otherwise.
 */
function verifyPassword($password, $hash) {
  return password_verify($password, $hash);
}
function getCommands($host, $dbname, $username, $password, $page, $records_per_page) {
  // PDO database connection
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Calculate the offset for the query
  $offset = ($page - 1) * $records_per_page;

  // Prepare the query statement with the offset and limit
  $stmt = $pdo->prepare("SELECT * FROM commands ORDER BY id DESC LIMIT :offset, :limit");
  $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
  $stmt->bindParam(':limit', $records_per_page, PDO::PARAM_INT);

  // Execute the query
  $stmt->execute();

  // Fetch all the rows as an associative array
  $commands = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Return the commands array
  return $commands;
}




function createPagination($pdo, $recordsPerPage) {
  // Get total number of records from the commands table
  $stmt = $pdo->query("SELECT COUNT(*) FROM commands");
  $totalRecords = $stmt->fetchColumn();

  // Calculate total number of pages
  $totalPages = ceil($totalRecords / $recordsPerPage);

  // Get current page number from the URL query string
  $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

  // Validate current page number
  if ($currentPage < 1 || $currentPage > $totalPages) {
    $currentPage = 1;
  }

  // Calculate offset for SQL query
  $offset = ($currentPage - 1) * $recordsPerPage;

  // Build SQL query to fetch records for current page
  $sql = "SELECT id, title, prompt, writer FROM commands LIMIT $offset, $recordsPerPage";
  $stmt = $pdo->query($sql);

  // Output records
  while ($row = $stmt->fetch()) {
    echo "<tr>";
    echo "<td>{$row['id']}</td>";
    echo "<td>{$row['title']}</td>";
    echo "<td>{$row['prompt']}</td>";
    echo "<td>{$row['writer']}</td>";
    echo "</tr>";
  }

  // Build pagination links
  echo "<div class='pagination'>";
  for ($i = 1; $i <= $totalPages; $i++) {
    $class = ($i == $currentPage) ? 'active' : '';
    echo "<a href='index.php?page=$i' class='$class'>$i</a>";
  }
  echo "</div>";
}

function countRecords($host, $dbname, $username, $password, $table_name) {
  try {
    
    // PDO database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
  
  // Prepare the query statement
  $stmt = $pdo->prepare("SELECT COUNT(*) FROM $table_name");
  
  // Execute the query
  $stmt->execute();
  
  // Fetch the number of records
  $total_records = $stmt->fetchColumn();
  
  // Return the number of records
  return $total_records;
}








?>
