# Gemini Agent Context: Alberto Rosas Personal Site

## Project Overview
This project is the personal portfolio and blog of Alberto Rosas (`alberto-rosas.dev`). It is a modern web application built with the **Laravel** ecosystem, designed to showcase professional experience, technical skills, and consultation services.

### Core Technologies
*   **Framework:** Laravel 11.x
*   **Frontend:** Livewire 3.x, Alpine.js, Tailwind CSS
*   **CMS:** `prezet` (Flat-file Markdown blog engine for Laravel)
*   **Asset Management:** Vite

## Key Directories & Files

### Configuration & Routes
*   `routes/web.php`: **CRITICAL**. Defines the main page content structure. Data for the Home, About, Services, Experience, and Skills sections is hardcoded here as arrays passed to the `welcome` view. **Modifying website content starts here.**
*   `config/prezet.php`: Configuration for the Markdown blog.

### Views (Frontend)
*   `resources/views/welcome.blade.php`: The single-page application (SPA) entry point. It orchestrates the sections using `include`.
*   `resources/views/components/site/`: Contains the Blade components for each section (`hero.blade.php`, `about.blade.php`, `skills.blade.php`, etc.).
*   `resources/views/livewire/contact-form.blade.php`: Handles the contact form submission logic.

### Content
*   `storage/prezet/content/`: Contains the blog posts in Markdown format.
*   `public/resume_alberto_rosas.pdf`: The downloadable resume.

## Development & Usage

### Setup
1.  **Install Dependencies:** `composer install` && `npm install`
2.  **Environment:** Copy `.env.example` to `.env` and configure database (sqlite by default for local).
3.  **Key Generation:** `php artisan key:generate`

### Running Locally
*   **Backend:** `php artisan serve`
*   **Frontend (HMR):** `npm run dev` (Vite)

### Deployment
*   **Build Assets:** `npm run build`
*   **Optimization:** `php artisan config:cache`, `php artisan route:cache`, `php artisan view:cache`

## User Persona & Goals
**User:** Alberto Rosas (Senior Software Engineer / AI Engineer)
**Goal:** To transition the personal brand from "Full Stack Developer" to **"AI Engineer & Strategic Consultant"**, aligning with the external service **Triage Ops**.
**Current Focus:** Modernizing the website to highlight AI expertise, strategic consulting, and operational efficiency.
