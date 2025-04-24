# Subscription Management System

## Overview

This Project is A Challange Task

## Installation

Here are the steps to get this project up and running:

1.  ## Prerequisites:\*\* (The version given below is the version I am using)

-   **PHP**: 8.2.28
-   **Node.js**: 23.5.0
-   **Composer**: 2.6.6
-   **Laragon** (for serving the project locally)

3.  ## Clone the repository:

    ```bash
    git clone https://github.com/Riderr470/subscriptionManagement.git
    cd [Project Name]
    ```

4.  ## Install Dependencies

```bash
composer install
npm install
```

5.  ## Configuration

```bash
# Extract main.zip and copy its content.
# Create .env file.
# Paste the extracted values into your .env file.
```

6.  ## Database Setup

```bash
php artisan migrate --seed
```

7.  ## Running the Application

All of these commands are needed to run the projects all features
Run the following commands in separate terminal windows or use a process manager:

### 1. Start the Laravel development server

```bash
php artisan serve
```

### 2. Start the Vite development server for frontend assets

```bash
npm run dev
```

### 3. Start the queue worker for background jobs

```bash
php artisan queue:work
```

### 4. Redis server needs to be Installed (for redis caching)

For windows bash:(cmd has some issue. server terminates after few minutes)

```bash
wsl sudo apt update
wsl sudo apt install redis-server
```

For linux/ubuntu terminal:

```bash
sudo apt update
sudo apt install redis-server
```

### 5. Check if Redis is running (for redis caching)

For windows bash:(cmd has some issue. server terminates after few minutes)

```bash
wsl sudo service redis-server start
```

For linux/ubuntu terminal:

```bash
sudo service redis-server start
redis-cli ping
# Expected response: PONG
```

## Features

✅ Project Features & Completed Tasks
This project implements several foundational backend concepts using Laravel with mock integrations and simulated environments. The following core features have been completed, fulfilling the minimum required functionality:

🔐 Task 1: Subscription Management System (Mock Stripe Integration)
Designed a simple subscription management flow supporting multiple plans and billing cycles.

Implemented mock logic for handling Stripe payments, including simulated success and failure scenarios.

Built basic routes for subscribing, canceling, and viewing subscription status.

Demonstrated secure handling of API keys and sensitive data using environment configuration best practices.

📢 Task 2: Basic Real-time Notification System (Simulated WebSocket)
Set up Laravel event broadcasting to simulate real-time notifications (e.g., on user registration).

Created a minimal frontend interface to display received notifications.

Used Laravel's built-in broadcasting features without requiring third-party WebSocket services.

🚀 Task 3: Product Data Caching Strategy
Identified performance bottlenecks in fetching product details from a large dataset.

Implemented caching using Laravel’s cache system (with Redis driver) to improve performance.

Demonstrated performance improvement by comparing response times before and after caching.

✅ Task 4: Basic Task Management System with Queues
Built a basic task management module where users can create and view tasks.

Integrated Laravel queues to handle asynchronous job processing.

Configured a queued job to send a welcome email upon task creation.
