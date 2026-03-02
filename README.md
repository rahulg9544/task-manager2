# AI-Assisted Task Management System (Senior Laravel Test)

## 🏗 Architecture Overview
This project follows **Clean Architecture** principles to ensuring maintainability, testability, and scalability.

- **Repository Pattern**: All data access is abstracted via Interfaces (`TaskRepositoryInterface`). No direct Eloquent calls exist in Controllers.
- **Service Layer**: Business logic, transactional operations, and AI triggers are centralized in `TaskService`.
- **Policy-Based Security**: Task access and role-based permissions (Admin vs User) are handled via `TaskPolicy`.
- **API Resources**: Data transformation for REST endpoints is managed through `TaskResource`.
- **Enums**: Priority and Status are strictly typed using PHP 8.1+ Enums.

## 🤖 AI Integration Strategy
The system integrates an `AIService` that automatically processes tasks upon creation or significant update.

### AI Prompt Logic
The prompt sent to the AI (currently mocked for evaluation) is designed to:
1.  **Summarize**: Convert long descriptions into concise, actionable summaries.
2.  **Estimate Priority**: Analyze the urgency based on description content and keywords.

**Draft Prompt:**
> "Analyze the following task Title: [TITLE] and Description: [DESCRIPTION]. Provide a 1-sentence executive summary and suggest a priority level (low, medium, high) based on corporate urgency."

## 🚀 Tech Stack
- **Backend**: Laravel 11.x, MySQL
- **Frontend**: Blade, Tailwind CSS (Rich Aesthetics: Glassmorphism, Dark Theme, Outfit Typography)
- **Auth**: Laravel Breeze
- **API**: Sanctum

## 🛠 Setup Instructions
1.  `composer install`
2.  `cp .env.example .env` (Update DB credentials for MySQL)
3.  `php artisan key:generate`
4.  `php artisan migrate --seed`
5.  `npm install && npm run dev`

## 👤 Test Credentials
- **Admin**: admin@test.com / password
- **User**: user@test.com / password

