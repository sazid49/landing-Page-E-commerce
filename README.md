🛒 Laravel eCommerce Cart & Order Management System

A complete mini eCommerce system built with Laravel, featuring product management, cart functionality, order processing, and automatic stock management.

🚀 Features
🧾 Product Management (CRUD)
Create Product
Update Product
Delete Product
Product Image Upload
Stock Management
🛍️ Frontend Features
Product Listing Page
Add to Cart (Session-based)
Update Quantity (AJAX)
Remove from Cart
Real-time Cart Total Calculation
🚚 Delivery System
Inside Dhaka → ৳60
Outside Dhaka → ৳120
Dynamic Delivery Charge Calculation
📦 Order System
Checkout Form (Name, Phone, Address)
Order Submission
Store Order + Order Items
Auto Calculate:
Subtotal
Delivery Charge
Grand Total
📉 Stock Management
Product stock automatically decreases after order placement
Prevent ordering if stock is insufficient
🧑‍💼 Admin Panel
View All Orders
Order Status Update (Pending → Confirmed → Delivered)
Order Management System
🛠️ Tech Stack
Laravel 8+
PHP
MySQL
JavaScript (Fetch API)
Tailwind CSS

📂 Project Setup (Step-by-Step)
1️⃣ Clone Repository
git clone  https://github.com/sazid49/landing-Page-E-commerce.git
cd your-repo-name

2️⃣ Install Dependencies
composer install

3️⃣ Setup Environment File
cp .env.example .env

4️⃣ Generate App Key
php artisan key:generate

5️⃣ Configure Database

Edit .env:

DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=
6️⃣ Run Migrations
php artisan migrate
7️⃣ Storage Link (for images)
php artisan storage:link
8️⃣ Run Server
php artisan serve

Open in browser:

http://127.0.0.1:8000
