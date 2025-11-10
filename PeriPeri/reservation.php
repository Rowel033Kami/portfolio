<?php
include_once('conn.php');

// Fetch all reservations
$sql = "SELECT r.*, t.table_number FROM reservations r JOIN tables t ON r.table_id = t.id ORDER BY r.date ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation List</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(145deg, #1e1e2f, #23243a);
            color: #ffffff;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 2rem;
        }
        .heading {
            text-align: center;
            margin-bottom: 2rem;
        }
        .reservation-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        .reservation-card {
            padding: 1rem;
            border-radius: 15px;
            background: linear-gradient(145deg, #283048, #334e68);
            color: #ffffff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .reservation-card:hover {
            transform: translateY(-10px);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.7);
        }
        .reservation-card h3 {
            margin: 0.5rem 0;
            color: #00ff88;
        }
        .reservation-card p {
            margin: 0.3rem 0;
            color: #d1d1d1;
        }
        .reservation-card .detail {
            margin-top: 0.5rem;
            padding: 0.5rem;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .detail span {
            font-size: 0.85rem;
        }
        .detail strong {
            font-size: 1rem;
            color: #00ff88;
        }
        .action-buttons {
            margin-top: 1rem;
            display: flex;
            justify-content: space-between;
        }
        .action-buttons button {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background: linear-gradient(145deg, #ff4545, #c73030);
            color: #ffffff;
            transition: background 0.3s ease;
        }
        .action-buttons button:hover {
            background: linear-gradient(145deg, #c73030, #ff4545);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="heading">
            <h1>Reservation List</h1>
        </div>
        <div class="reservation-grid">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="reservation-card">
                        <h3>Guest: <?php echo htmlspecialchars($row['name']); ?></h3>
                        <p>Email: <?php echo htmlspecialchars($row['email']); ?></p>
                        <p>Phone: <?php echo htmlspecialchars($row['phone']); ?></p>
                        <div class="detail">
                            <span>Table:</span>
                            <strong>#<?php echo htmlspecialchars($row['table_number']); ?></strong>
                        </div>
                        <div class="detail">
                            <span>Guests:</span>
                            <strong><?php echo htmlspecialchars($row['guests']); ?></strong>
                        </div>
                        <div class="detail">
                            <span>Time:</span>
                            <strong><?php echo htmlspecialchars(date('d M Y, h:i A', strtotime($row['date']))); ?></strong>
                        </div>
                        <div class="action-buttons">
                            <button onclick="editReservation(<?php echo $row['id']; ?>)">Edit</button>
                            <button onclick="deleteReservation(<?php echo $row['id']; ?>)">Cancel</button>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No reservations available.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function editReservation(id) {
            alert('Edit functionality for reservation ID: ' + id);
            // You can redirect to the edit page or open a modal for editing.
        }
        
        function deleteReservation(id) {
            if (confirm('Are you sure you want to cancel this reservation?')) {
                // You can make an AJAX call here or redirect to a delete script.
                alert('Reservation ID ' + id + ' cancelled.');
            }
        }
    </script>
</body>
</html>
