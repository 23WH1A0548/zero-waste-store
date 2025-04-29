<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>About Us - Conserve Co</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #fdfdfd;
      color: #333;
    }

    header {
      background-color: #556b2f;
      color: white;
      padding: 20px;
      text-align: center;
    }

    header h1 {
      margin: 0;
    }

    section {
      display: flex;
      flex-wrap: wrap;
      padding: 40px 10%;
      align-items: center;
      border-bottom: 1px solid #ddd;
    }

    section:nth-child(even) {
      flex-direction: row-reverse;
      background-color: #f3f7f3;
    }

    .text {
      flex: 1;
      min-width: 300px;
      padding: 20px;
    }

    .text h2 {
      color: #556b2f;
    }

    .text ul {
      padding-left: 20px;
    }

    .image {
      flex: 1;
      min-width: 300px;
      text-align: center;
      padding: 20px;
    }

    .image img {
      width: 100%;
      max-width: 450px;
      height: 300px;
      object-fit: cover;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .join-us {
      text-align: center;
      background-color: #eaf2e1;
      padding: 50px 20px;
    }

    .join-us h2 {
      color: #556b2f;
      font-size: 2em;
    }

    .join-us p {
      margin: 20px 0;
      font-size: 1.1em;
    }

    .join-us a {
      display: inline-block;
      padding: 12px 25px;
      background-color: #556b2f;
      color: white;
      text-decoration: none;
      font-weight: bold;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    .join-us a:hover {
      background-color: #445522;
    }

    footer {
      background-color: #333;
      color: white;
      text-align: center;
      padding: 15px 10px;
    }

    @media (max-width: 768px) {
      section {
        flex-direction: column !important;
      }

      .image img {
        max-width: 100%;
        height: auto;
      }
    }
  </style>
</head>
<body>

<header>
  <h1>Welcome to Conserve Co</h1>
  <p>Committed to a Sustainable Future</p>
</header>

<section>
  <div class="text">
    <h2>Our Mission</h2>
    <ul>
      <li>Promote eco-friendly practices through technological innovation</li>
      <li>Encourage environmental education and community awareness</li>
      <li>Implement sustainable development initiatives</li>
      <li>Reduce environmental footprint by supporting green alternatives</li>
    </ul>
  </div>
  <div class="image">
    <img src="https://i.pinimg.com/736x/85/ce/4f/85ce4fa432de9df38582574888d9fcf9.jpg" alt="Our Mission Image" />
  </div>
</section>

<section>
  <div class="text">
    <h2>Our Projects</h2>
    <ul>
      <li>Recycling drives and zero-waste programs</li>
      <li>Renewable energy installations in rural areas</li>
      <li>Reforestation and wildlife conservation campaigns</li>
      <li>Educational workshops and eco-tourism initiatives</li>
    </ul>
  </div>
  <div class="image">
    <img src="https://i.pinimg.com/736x/03/5d/70/035d7031d5e350e951425e5ff757f4a2.jpg" alt="Our Projects Image" />
  </div>
</section>

<section>
  <div class="text">
    <h2>Our Values</h2>
    <ul>
      <li><strong>Integrity:</strong> We act with honesty and transparency</li>
      <li><strong>Sustainability:</strong> Every action is designed for long-term impact</li>
      <li><strong>Innovation:</strong> Constantly exploring greener solutions</li>
      <li><strong>Community:</strong> Empowering local voices and contributions</li>
    </ul>
  </div>
  <div class="image">
    <img src="https://i.pinimg.com/736x/1d/17/f5/1d17f5a4b056ca9dd9209e4cf3d71c01.jpg" alt="Our Values Image" />
  </div>
</section>

<section>
  <div class="text">
    <h2>Inspiring Change</h2>
    <p>Through outreach and action, Conserve Co inspires individuals and organizations to embrace sustainability and environmental stewardship. Together, we create meaningful change that uplifts communities and protects nature for generations to come.</p>
  </div>
  <div class="image">
    <img src="https://i.pinimg.com/736x/24/8d/fc/248dfc51b2c46ec21aac6da8f505f4b3.jpg" alt="Inspiring Change Image" />
  </div>
</section>

<div class="join-us">
  <h2>Join Us</h2>
  <p>Be a part of our journey towards a greener planet.</p>
  <a href="register.php">Register Here</a>
</div>

<footer>
  &copy; 2025 Conserve Co. All rights reserved.
</footer>

</body>
</html>
