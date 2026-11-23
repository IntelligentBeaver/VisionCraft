# VisionCraft: AI Job Matching and Career Recommendation Platform

**VisionCraft** is an AI-powered job recommendation and career guidance web app built with **Laravel 12**, **Livewire 3** and a **Python Flask** machine-learning service. Job seekers answer a short career survey and get ranked job matches from a TF-IDF and cosine-similarity model. They can also turn a PDF resume into an ATS-friendly Word document.

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-3-4E56A6?logo=livewire&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?logo=php&logoColor=white)
![Python](https://img.shields.io/badge/Python-3.13-3776AB?logo=python&logoColor=white)
![Flask](https://img.shields.io/badge/Flask-3-000000?logo=flask&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3-06B6D4?logo=tailwindcss&logoColor=white)

## Table of Contents

- [Features](#features)
- [How It Works](#how-it-works)
- [Tech Stack](#tech-stack)
- [Getting Started](#getting-started)
- [Configuration](#configuration)
- [Running Tests](#running-tests)
- [Project Structure](#project-structure)
- [Security Notes](#security-notes)

## Features

### Job seekers
- Sign up with email and password, or log in with **Google** or **LinkedIn** (OAuth via Laravel Socialite).
- Take a step-by-step **career survey** covering skills, industry and functional area.
- Get the **top 5 job recommendations**, each with title, industry, functional area, role and similarity score.
- Browse **survey history** and past recommendations on a personal dashboard.
- Upload a PDF resume and download an **ATS-optimized .docx** version.
- Manage profile details such as skills, education, experience and interests.

### Admins
- See user statistics on an admin dashboard.
- Create, edit and delete users and assign roles.
- Only `admin` users can open admin pages, enforced on routes and on every Livewire action.

## How It Works

```
Browser ──► Laravel 12 + Livewire 3 ──HTTP──► Flask ML API (127.0.0.1:5000)
                 │                               ├─ /recommend      TF-IDF + cosine similarity over job data
                 │                               ├─ /upload_resume  PDF ➜ sections ➜ ATS-friendly .docx
                 ▼                               └─ /download/<file>
              MySQL (users, surveys, responses, recommendations, resumes)
```

1. Survey answers are saved as `surveys` and `responses`.
2. Laravel sends skills, industry and functional area to Flask through `App\Services\FlaskClient`.
3. Flask vectorizes the input with the pre-trained `tfidf_vectorizer0.pkl` and ranks jobs from `job_data.pkl`.
4. Laravel saves the results in `recommendations` and shows them on the dashboard.

## Tech Stack

| Layer | Tools |
|---|---|
| Backend | Laravel 12, PHP 8.2+, Livewire 3, Laravel Socialite |
| Frontend | Blade, Tailwind CSS 3, DaisyUI 4, Vite 5 |
| ML service | Python, Flask, scikit-learn 1.6.1, pandas, pdfplumber, python-docx |
| Database | MySQL (SQLite in-memory for tests) |
| Testing | Pest 3 |

## Getting Started

### Prerequisites
- PHP 8.2+ and Composer (for example via [Laravel Herd](https://herd.laravel.com))
- Node.js 18+ and npm
- Python 3.13
- MySQL

### 1. Laravel app

```bash
git clone <repo-url> job-matching
cd job-matching
composer install
npm install
cp .env.example .env
php artisan key:generate
# set DB_* in .env, then:
php artisan migrate --seed
php artisan db:seed --class=AdminSeeder   # optional: creates admin@admin.com
npm run build
php artisan serve
```

> Change the seeded admin password (`password`) right after the first login.

### 2. Flask ML API

```bash
cd flask_api
python -m venv venv
venv\Scripts\activate        # Windows  (source venv/bin/activate on macOS/Linux)
pip install -r requirements.txt
python app.py                # serves on http://127.0.0.1:5000
```

`scikit-learn` is pinned to **1.6.1** because the `.pkl` models were trained with that version.

## Configuration

| Variable | Purpose | Default |
|---|---|---|
| `FLASK_API_URL` | Base URL of the Flask service | `http://127.0.0.1:5000` |
| `FLASK_API_TIMEOUT` | HTTP timeout in seconds | `30` |
| `GOOGLE_CLIENT_ID`, `GOOGLE_CLIENT_SECRET`, `GOOGE_CALLBACK_REDIRECTS` | Google OAuth | – |
| `LINKEDIN_CLIENT_ID`, `LINKEDIN_CLIENT_SECRET`, `LINKEDIN_CALLBACK_REDIRECTS` | LinkedIn OpenID | – |

Environment variables for Flask:

| Variable | Purpose | Default |
|---|---|---|
| `FLASK_HOST` | Bind address | `127.0.0.1` |
| `FLASK_PORT` | Port | `5000` |
| `FLASK_DEBUG` | Set to `1` only for local debugging | `0` |

## Running Tests

```bash
php artisan test
```

Tests use an in-memory SQLite database, so they never touch your MySQL data. They cover admin authorization, OAuth login and account linking, resume ownership, and handling of Flask outages.

## Project Structure

```
app/
  Http/Controllers/     ResController (resume + recommendation forms), Socialite, Profile
  Http/Middleware/      EnsureUserIsAdmin
  Livewire/             QuestionCard (survey), ResumeOptimizer, Dashboard/*, Auth/*
  Livewire/Concerns/    AuthorizesAdmin
  Models/               User, Survey, Questions, Response, Recommendation, Resume, Industry, ...
  Services/             FlaskClient: the only place that talks to the Flask API
flask_api/              Flask app, trained models (*.pkl), generated resumes
docs/mockups/           HTML resume mockups
tests/Feature/          Pest feature tests
```

## Security Notes

- Users can only download and delete resumes they created. New resumes are stored on the private `local` disk.
- OAuth accounts get a random password. An OAuth login links to an existing account only when the provider has verified the email.
- Flask debug mode is off by default and the service binds to localhost. Do not expose it publicly.
