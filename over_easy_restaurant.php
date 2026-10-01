<?php
$reservation_success = false;
$customer_name = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $customer_name = htmlspecialchars($_POST['fullName'] ?? 'Guest');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $date = htmlspecialchars($_POST['date'] ?? '');
    $time = htmlspecialchars($_POST['time'] ?? '');
    $guests = htmlspecialchars($_POST['guests'] ?? '');


    if (!empty($customer_name) && !empty($email) && !empty($date) && !empty($time)) {
        $reservation_success = true;
    }
}


$menu_items = [
    [
        "image" => "https://images.unsplash.com/photo-1551782450-a2132b4ba21d?auto=format&fit=crop&w=800&q=80",
        "title" => "Golden Sunrise Omelette",
        "description" => "Farm fresh eggs, herbs, aged cheese.",
        "price" => "₱400"
    ],
    [
        "image" => "https://images.unsplash.com/photo-1551183053-bf91a1d81141?auto=format&fit=crop&w=800&q=80",
        "title" => "Emerald Avocado Toast",
        "description" => "Sourdough, smashed avocado, poached egg.",
        "price" => "₱350"
    ],
    [
        "image" => "https://images.unsplash.com/photo-1608039829572-78524f79c4c7?auto=format&fit=crop&w=800&q=80",
        "title" => "Black Truffle Benedict",
        "description" => "Poached eggs, truffle hollandaise, brioche.",
        "price" => "₱350"
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Over Easy | Elevated Dining</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #000;
            color: #f5f5f5;
        }

        :root {
            --black: #000000;
            --deep-green: #0f3d2e;
            --emerald: #00a86b;
            --gold: #d4af37;
        }

        /* NAV */
        nav {
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            background: linear-gradient(90deg, var(--black), var(--deep-green));
            padding: 18px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--gold);
        }

        nav h1 {
            font-family: 'Playfair Display', serif;
            color: var(--gold);
            letter-spacing: 3px;
            font-size: 22px;
        }

        nav ul {
            display: flex;
            gap: 25px;
            list-style: none;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            font-size: 14px;
            transition: .3s;
        }

        nav a:hover {
            color: var(--gold);
        }

        /* HERO */
        header {
            height: 100vh;
            background: linear-gradient(rgba(0,0,0,.75), rgba(15,61,46,.85)), url('https://images.unsplash.com/photo-1498654896293-37aacf113fd9?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }

        header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 60px;
            color: var(--gold);
        }

        header span {
            color: var(--emerald);
        }

        header p {
            max-width: 600px;
            margin: 20px 0;
            color: #ddd;
        }

        header button {
            padding: 14px 35px;
            border: none;
            border-radius: 40px;
            background: linear-gradient(45deg, var(--gold), var(--emerald));
            color: #000;
            font-weight: bold;
            cursor: pointer;
            transition: .4s;
        }

        header button:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px var(--gold);
        }

        section {
            padding: 100px 8%;
        }

        section h2 {
            font-family: 'Playfair Display', serif;
            font-size: 38px;
            text-align: center;
            margin-bottom: 40px;
            color: var(--gold);
        }

        /* ABOUT */
        #about {
            background: var(--deep-green);
            text-align: center;
            line-height: 1.8;
            border-top: 1px solid var(--gold);
            border-bottom: 1px solid var(--gold);
        }

        /* MENU */
        #menu {
            background: #000;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .menu-card {
            background: linear-gradient(145deg, #000, var(--deep-green));
            border: 1px solid var(--gold);
            border-radius: 20px;
            padding: 20px;
            text-align: center;
            transition: .4s;
        }

        .menu-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 0 25px var(--emerald);
        }

        .menu-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 15px;
        }

        .menu-card h3 {
            color: var(--gold);
            margin-bottom: 10px;
        }

        .menu-card p {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .price {
            color: var(--emerald);
            font-weight: bold;
            font-size: 18px;
        }

        /* RESERVATION */
        #reservation {
            background: linear-gradient(135deg, var(--black), var(--deep-green));
            border-top: 1px solid var(--gold);
            border-bottom: 1px solid var(--gold);
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 15px;
            background: #000;
            padding: 35px;
            border-radius: 20px;
            border: 1px solid var(--gold);
        }

        form input, form select {
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: #111;
            color: #fff;
            font-family: 'Poppins', sans-serif;
        }
        
        form input[type="date"]::-webkit-calendar-picker-indicator,
        form input[type="time"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
        }

        form button {
            padding: 14px;
            border: none;
            border-radius: 40px;
            background: linear-gradient(45deg, var(--gold), var(--emerald));
            color: #000;
            font-weight: bold;
            cursor: pointer;
            transition: .4s;
            margin-top: 10px;
        }

        form button:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px var(--gold);
        }

        /* CONTACT */
        #contact {
            background: #000;
            text-align: center;
        }

        iframe {
            width: 100%;
            height: 350px;
            border: none;
            border-radius: 15px;
            margin-top: 20px;
            border: 1px solid var(--gold);
        }

        footer {
            background: var(--deep-green);
            padding: 25px;
            text-align: center;
            color: #ccc;
            border-top: 1px solid var(--gold);
            font-size: 14px;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.85);
            z-index: 2000;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(5px);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.show {
            display: flex;
            opacity: 1;
        }

        .modal-content {
            background: linear-gradient(145deg, var(--black), var(--deep-green));
            border: 1px solid var(--gold);
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            transform: translateY(20px);
            transition: transform 0.3s ease;
        }
        
        .modal-overlay.show .modal-content {
            transform: translateY(0);
        }

        .modal-content h3 {
            font-family: 'Playfair Display', serif;
            color: var(--gold);
            font-size: 24px;
            margin-bottom: 15px;
        }

        .modal-content p {
            margin-bottom: 25px;
            font-size: 14px;
            color: #ddd;
        }

        .modal-content button {
            padding: 10px 30px;
            border: none;
            border-radius: 40px;
            background: linear-gradient(45deg, var(--gold), var(--emerald));
            color: #000;
            font-weight: bold;
            cursor: pointer;
            transition: .4s;
        }
        
        .modal-content button:hover {
            box-shadow: 0 0 15px var(--emerald);
        }

        @media(max-width: 768px) {
            header h2 {
                font-size: 40px;
            }
            nav ul {
                display: none;
            }
        }
    </style>
</head>
<body>
    <nav>
        <h1>OVER EASY</h1>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#menu">Menu</a></li>
            <li><a href="#reservation">Reservation</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </nav>

    <header>
        <h2>Welcome to <span>Over Easy</span></h2>
        <p>Where bold flavors meet refined elegance. A modern dining experience wrapped in black sophistication, emerald richness, and golden luxury.</p>
        <button onclick="document.getElementById('reservation').scrollIntoView()">Book a Table</button>
    </header>

    <section id="about">
        <h2>Our Story</h2>
        <p>Over Easy was crafted to redefine comfort cuisine with a luxurious twist. Inspired by timeless culinary artistry and modern creativity, we blend premium ingredients with elegant presentation. Every plate is designed to turn simple moments into unforgettable experiences.</p>
    </section>

    <section id="menu">
        <h2>Signature Menu</h2>
        <div class="menu-grid">
            <?php foreach ($menu_items as $item): ?>
                <div class="menu-card">
                    <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
                    <h3><?php echo $item['title']; ?></h3>
                    <p><?php echo $item['description']; ?></p>
                    <div class="price"><?php echo $item['price']; ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section id="reservation">
        <h2>Reserve Your Table</h2>
        
        <form id="reservationForm" method="POST" action="#reservation">
            <input type="text" name="fullName" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="date" name="date" required>
            <input type="time" name="time" required>
            <select name="guests" required>
                <option value="" disabled selected>Number of Guests</option>
                <option value="1">1 Person</option>
                <option value="2">2 People</option>
                <option value="3-4">3-4 People</option>
                <option value="5+">5+ People</option>
            </select>
            <button type="submit">Confirm Reservation</button>
        </form>
    </section>

    <section id="contact">
        <h2>Visit Over Easy</h2>
        <p>Over Easy, Marikina, 1800 Metro Manila</p>
        <p style="margin-top: 10px; margin-bottom: 20px;">Email: reservations@overeasy.com &nbsp;|&nbsp; Phone: +123 456 7890</p>
        <iframe src="https://maps.google.com/maps?q=Marikina, 1800 Metro Manila&output=embed" title="Over Easy Location Map" loading="lazy"></iframe>
    </section>

    <footer>
        © <?php echo date("Y"); ?> Over Easy. Crafted in Black, Green & Gold.
    </footer>

    
    <div class="modal-overlay" id="successModal">
        <div class="modal-content">
            <h3>Table Reserved!</h3>
            <p>Thank you, <strong><?php echo $customer_name; ?></strong>. Your reservation has been received. We look forward to serving you an elevated dining experience.</p>
            <button onclick="closeModal()">Close</button>
        </div>
    </div>

    <script>
        const successModal = document.getElementById('successModal');

        function closeModal() {
            successModal.classList.remove('show');
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href.split('#')[0]);
            }
        }

        
        window.onclick = function(event) {
            if (event.target === successModal) {
                closeModal();
            }
        }
    </script>

    <?php 
    if ($reservation_success): 
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('successModal').classList.add('show');
            
            document.getElementById('reservation').scrollIntoView();
        });
    </script>
    <?php endif; ?>

</body>
</html>