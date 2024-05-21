<?php

session_start();
require "connection.php";
$email;
if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];
}
$x = 3; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZINIC | Services</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" href="./logoH.jpeg">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 960px;
            margin: auto;
            padding: 20px;
        }

        h1,
        h2,
        h3 {
            color: #333;
        }

        p {
            color: #666;
        }

        .service-card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1);
        }

        .service-icon {
            font-size: 3rem;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <?php include "header.php"; ?>
    <div class="container">
        <h1 class="mb-4">Our Services</h1>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card service-card">
                    <div class="card-body text-center">
                        <i class="bi bi-lightbulb service-icon"></i>
                        <h3 class="card-title">Personalized Product Recommendations</h3>
                        <p class="card-text">Get personalized recommendations based on your preferences and interests.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card service-card">
                    <div class="card-body text-center">
                        <i class="bi bi-tools service-icon"></i>
                        <h3 class="card-title">Tech Support and Troubleshooting Guides</h3>
                        <p class="card-text">Access tech support services and troubleshooting guides for your electronic devices.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card service-card">
                    <div class="card-body text-center">
                        <i class="bi bi-arrow-repeat service-icon"></i>
                        <h3 class="card-title">Trade-in and Recycling Programs</h3>
                        <p class="card-text">Trade in your old devices for store credit or participate in our recycling programs.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card service-card">
                    <div class="card-body text-center">
                        <i class="bi bi-tools service-icon"></i>
                        <h3 class="card-title">DIY Electronics Kits</h3>
                        <p class="card-text">Build your own gadgets with our do-it-yourself electronics kits and instructional guides.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card service-card">
                    <div class="card-body text-center">
                        <i class="bi bi-shield-check service-icon"></i>
                        <h3 class="card-title">Extended Warranties and Protection Plans</h3>
                        <p class="card-text">Protect your purchases with extended warranties and protection plans.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card service-card">
                    <div class="card-body text-center">
                        <i class="bi bi-camera-video service-icon"></i>
                        <h3 class="card-title">Virtual Tech Workshops and Events</h3>
                        <p class="card-text">Participate in virtual tech workshops and events to learn about the latest technologies.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card service-card">
                    <div class="card-body text-center">
                        <i class="bi bi-palette service-icon"></i>
                        <h3 class="card-title">Customization Services</h3>
                        <p class="card-text">Personalize your gadgets with custom colors, engravings, or accessories.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card service-card">
                    <div class="card-body text-center">
                        <i class="bi bi-house-door service-icon"></i>
                        <h3 class="card-title">Smart Home Integration</h3>
                        <p class="card-text">Get assistance with setting up and integrating smart home devices.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card service-card">
                    <div class="card-body text-center">
                        <i class="bi bi-clock service-icon"></i>
                        <h3 class="card-title">Product Rental Services</h3>
                        <p class="card-text">Rent electronic devices for short-term use or testing purposes.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card service-card">
                    <div class="card-body text-center">
                        <i class="bi bi-recycle service-icon"></i>
                        <h3 class="card-title">Eco-Friendly Packaging Options</h3>
                        <p class="card-text">Choose from our eco-friendly packaging options to reduce environmental impact.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>

</html>