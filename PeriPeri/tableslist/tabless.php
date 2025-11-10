<?php
include_once('./conn.php');

// Fetch all tables
$sql = "SELECT * FROM tables";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Reservation</title>
    <!-- Futuristic Styles -->
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
    .table-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }
    .table-card {
        padding: 1rem;
        border-radius: 15px;
        text-align: center;
        background: rgba(255, 255, 255, 0.1);
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .table-card:hover {
        transform: translateY(-10px);
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.5);
    }
    .table-card h3 {
        margin: 0.5rem 0;
    }
    .table-card span {
        font-size: 0.9rem;
    }
    .available {
        background: linear-gradient(145deg, #00ff88, #00c974);
        color: #000;
    }
    .reserved {
        background: linear-gradient(145deg, #ff4545, #c73030);
        color: #fff;
    }
    /* Shorter modal styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        overflow: auto;
    }
    .modal-content {
        background-color: #fff;
        padding: 1.5rem;  /* Reduced padding */
        border-radius: 10px;
        width: 90%;  /* Reduced width for a more compact form */
        margin: auto;
        color: #333;
        max-height: 90%;  /* Restrict height */
        overflow-y: auto; /* Scrollable if content overflows */
    }
    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .close {
        color: #aaa;
        font-size: 1.5rem;
        font-weight: bold;
        cursor: pointer;
    }
    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
    }
    .modal input, .modal select, .modal button {
        margin: 1rem 0;
    padding: 0.8rem;
    border: 2px solid red; 
    border-radius: 10px;
    width: 100%;
    background-color: #f3f3f3;
    }
    .modal button {
        background: linear-gradient(145deg, #00ff88, #00c974);
        color: white;
        cursor: pointer;
        transition: 0.3s;
    }
    .modal button:hover {
        background: linear-gradient(145deg, #00c974, #00ff88);
    }
</style>
</head>
<body>
    <div class="container">
        <div class="heading">
            <h1>Table Reservation</h1>
        </div>
        <div class="table-grid">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="table-card <?php echo $row['is_available'] ? 'available' : 'unavailable'; ?>" 
                         <?php if ($row['is_available']): ?>onclick="openModal(<?php echo $row['id']; ?>)"<?php endif; ?>>
                        <h3>Table <?php echo htmlspecialchars($row['table_number']); ?></h3>
                        <p>Seats: <?php echo htmlspecialchars($row['seats']); ?></p>
                        <div>
                            <strong>
                                <?php echo $row['is_available'] ? 'Available' : 'Unavailable'; ?>
                            </strong>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No tables found in the database.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal for reservation form -->
    <div id="reservationModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Make a Reservation</h2>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <form method="POST" action="./tableslist/process_reservation.php">
                <input type="hidden" id="table_id" name="table_id" >
                <label for="name">Name</label>
                <input type="text" id="name" name="name" requiredstyle="border:2px solid red;">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" requiredstyle="border:2px solid red;">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" requiredstyle="border:2px solid red;">
                <label for="guests">Number of Guests</label>
                <input type="number" id="guests" name="guests" requiredstyle="border:2px solid red;">
                <label for="date">Reservation Date</label>
                <input type="datetime-local" id="date" name="date" requiredstyle="border:2px solid red;">
                <button type="submit">Reserve Table</button>
            </form>
        </div>
    </div>

    <script>
        // Open the modal and set table ID
        function openModal(tableId) {
            document.getElementById("table_id").value = tableId;
            document.getElementById("reservationModal").style.display = "block";
        }

        // Close the modal
        function closeModal() {
            document.getElementById("reservationModal").style.display = "none";
        }

        // Close modal if clicked outside the modal
        window.onclick = function(event) {
            if (event.target == document.getElementById("reservationModal")) {
                closeModal();
            }
        }
    </script>
</body>
</html>
