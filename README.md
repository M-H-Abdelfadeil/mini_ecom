# 🛒 MiniEcom – Laravel E-commerce API

**MiniEcom** is a multilingual e-commerce API built with **Laravel**, designed to provide a clean, scalable, and developer-friendly backend foundation for any online store or mobile commerce application.

> 🚧 **This project is currently under active development.**  
> The goal is to deliver a modular and secure API that can serve as the backbone of a modern e-commerce platform.

---

## ✨ Key Features

- 🧑‍💼 **User roles** with permissions: Owner, Admin, and Customer  
- 🌍 **Multilingual support** for products and categories (e.g. Arabic & English)  
- 🛍️ **Product & category management** with translations  
- 🛒 **Cart and order system** (In Progress)  
- 🔐 **API authentication** with Laravel Sanctum  
- 🧾 **Stock tracking** with alerting capabilities  
- 📊 **Dashboard-ready** APIs for stats & insights  
- ⚙️ Built with clean architecture (controllers, services, resources, requests)

---

## 🧰 Tech Stack

| Layer         | Technology           |
|---------------|----------------------|
| Backend       | Laravel              |
| Database      | MySQL                |
| Auth          | Laravel Sanctum      |
| Testing       | Postman              |


---

## 🚀 Getting Started

```bash
git clone https://github.com/YOUR_USERNAME/MiniEcom.git
cd MiniEcom
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

---

## 🧪 API Endpoints (Sample)

| Method | Endpoint            | Description                  |
|--------|---------------------|------------------------------|
| POST   | /api/register       | User registration            |
| POST   | /api/login          | User login (returns token)   |
| GET    | /api/products       | List all products            |
| POST   | /api/orders         | Place a new order            |
| GET    | /api/admin/orders   | Admin: View all orders       |

> Full Postman collection will be shared soon.

---

## 📌 Roadmap

## 🛣️ Roadmap

### 🛠️ Admin Panel Features

- [❌] **Admin Management**
  - Roles and permissions for owners, admins, and users
  - Full control over system access and actions

- [❌] **Categories Management**
  - Add / Edit / View / Enable / Disable / Search

- [❌] **Products Management**
  - Add / Edit / View / Enable / Disable / Filter by category/status/keywords

- [❌] **Coupons Management**
  - Add / Edit / View / Enable / Disable / Filter by type/status/keywords

- [❌] **Customers Management**
  - Add / Edit / View / Ban / Unban / Activate / Deactivate / Filter by status or name

- [❌] **Customer Addresses**
  - Add / Edit / Delete / View

- [❌] **Slider Management**
  - Add / Edit / Delete / View

- [❌] **Orders Management**
  - View orders / Filter by status/date/customer / Change order status

- [❌] **System Settings**
  - Order settings (e.g., order flow, thresholds)
  - Social media settings (links, visibility)

---

### 🌐 Website Features

- [❌] **Authentication**
  - Register / Login / Account Activation / Forgot Password

- [❌] **Homepage**
  - Dynamic slider / Featured categories / Featured products

- [❌] **All Products Page**
  - Filter by categories / prices / keywords

- [❌] **All Categories Page**

- [❌] **Product Details Page**

- [❌] **Shopping Cart**

- [❌] **Orders Page**

- [❌] **Profile Settings**
  - Update personal info / Change password


---

## 🤝 Contribution

If you'd like to contribute, feel free to fork this repo, submit a pull request, or open an issue.

---

## 🙋‍♂️ Maintained & Developed By

**Mahmoud Abdelfadil**  
👨‍💻 Backend Developer | Laravel Enthusiast  
📧 Email: mahmoudhasan.dev@gmail.com  
📱 Mobile: +20 102 601 0475  
🔗 LinkedIn: [linkedin.com/in/mahmoud-abdelfadil](https://www.linkedin.com/in/mahmoud-abdelfadil/)  
💻 GitHub: [github.com/MahmoudAbdelfadil](https://github.com/MahmoudAbdelfadil)

---

## 📜 License

This project is open-sourced under the [MIT license](LICENSE).
