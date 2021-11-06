<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$country = $_GET['country'];
$context = $_GET['context'];

$country = strtolower(filter_var($country, FILTER_SANITIZE_STRING));
$context = strtolower(filter_var($context, FILTER_SANITIZE_STRING));

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if($context == "cities"){
  $stmt = $conn->query("SELECT c.name, c.district, c.population FROM cities c join countries cs on c.country_code = cs.code WHERE cs.name LIKE '%$country%';");
} else {
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%';");
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if($context == "cities"): ?>
  <table>
    <tr>
      <th>Name</th>
      <th>District</th>
      <th>Population</th>
    </tr>
    <?php foreach($results as $row): ?>
      <tr>
        <td><?= $row['name']; ?></td>
        <td><?= $row['district'];?></td>
        <td><?= $row['population']; ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
<?php else: ?>
    <table>
      <tr>
        <th>Country Name</th>
        <th>Continent</th>
        <th>Independence</th>
        <th>Head of State</th>
      </tr>
      <?php foreach($results as $row): ?>
        <tr>
          <td><?= $row['name']; ?></td>
          <td><?= $row['continent'];?></td>
          <td><?= $row['independence_year']; ?></td>
          <td><?= $row['head_of_state']; ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
<?php endif; ?>
