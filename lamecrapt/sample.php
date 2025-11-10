<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Starbucks Coffee</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    background-color: #f4f4f4;
}

header {
    background-color: #00704A; /* Starbucks Green */
    color: white;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    font-size: 24px;
    font-weight: bold;
}

nav ul {
    list-style-type: none;
    padding: 0;
}

nav ul li {
    display: inline;
    margin: 0 15px;
}

nav ul li a {
    color: white;
    text-decoration: none;
}

.hero {
    background: url('starbucks-hero.jpg') no-repeat center center/cover;
    color: white;
    padding: 100px 20px;
    text-align: center;
}

.cta-button {
    background-color: #fff;
    color: #00704A;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
}

main {
    padding: 20px;
}

h2 {
    margin-top: 40px;
}

.menu-items {
    display: flex;
    justify-content: space-between;
    gap: 20px;
}

.menu-item {
    background-color: #e2e2e2;
    padding: 15px;
    border-radius: 8px;
    flex: 1;
}

footer {
    text-align: center;
    padding: 15px;
    background-color: #00704A;
    color: white;
    position: relative;
    bottom: 0;
    width: 100%;
}

    </style>
</head>
<body>
    <header>
        <div class="logo">Starbucks</div>
        <nav>
            <ul>
                <li><a href="#menu">Menu</a></li>
                <li><a href="#locations">Locations</a></li>
                <li><a href="#about">About Us</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="hero">
            <h1>Welcome to Starbucks</h1>
            <p>Your favorite coffee shop, now serving quality and convenience.</p>
            <a href="#menu" class="cta-button">View Menu</a>
        </section>
        <section id="menu">
            <h2>Our Menu</h2>
            <div class="menu-items">
                <div class="menu-item">
                    <h3>Espresso</h3>
                    <p>Rich and bold espresso shot.</p>
                </div>
                <div class="menu-item">
                    <h3>Latte</h3>
                    <p>Espresso with steamed milk.</p>
                </div>
                <div class="menu-item">
                    <h3>Frappuccino</h3>
                    <p>Blended coffee drink with ice.</p>
                </div>
            </div>
        </section>
        <section id="locations">
            <h2>Find Us</h2>
            <p>Discover our locations near you.</p>
            <ul>
                <li>Location 1: 123 Coffee St.</li>
                <li>Location 2: 456 Brew Ave.</li>
                <li>Location 3: 789 Espresso Blvd.</li>
            </ul>
        </section>
        <section id="about">
            <h2>About Us</h2>
            <p>At Starbucks, we believe in serving great coffee and creating a welcoming environment.</p>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Starbucks Coffee. All Rights Reserved.</p>
    </footer>
</body>
</html>
