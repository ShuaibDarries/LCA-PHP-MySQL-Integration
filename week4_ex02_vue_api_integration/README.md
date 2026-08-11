# TechVibe

## Description
TechVibe is an online store product catalogue built for the marketing team. It provides a simple interface to view, add, and remove products from the internal inventory without page reloads.

## Tech Stack
- **Node.js** — JavaScript runtime for the backend server.
- **Express** — Web framework for building RESTful API routes.
- **Vue 3** — Progressive frontend framework for building the user interface.
- **Vite** — Fast development build tool and dev server for the Vue frontend.
- **Axios** — Promise-based HTTP client for making API requests from Vue to the Node.js backend.

## Prerequisites
- Node.js installed
- npm available in the terminal
- A `.env` file in the `server/` folder is required (see Environment Variables below)

## Environment Variables
Create a `.env` file inside the `server/` folder with the following variable:
```
PORT=3000
```

## Installation
1. Clone the repository.
2. Run `npm install` inside the `server/` folder.
3. Run `npm install` inside the `client/` folder.
4. Create a `.env` file in `server/` based on the Environment Variables section above.

## How to Run
1. Start the backend: `cd server && npm start` (uses nodemon).
2. Start the frontend: `cd client && npm run dev` (uses Vite).
3. Open the provided Vite local URL in your browser.

## API Endpoints
| Method | Endpoint        | Description                          |
|--------|-----------------|--------------------------------------|
| GET    | /products       | Returns the full products array      |
| POST   | /products       | Adds a new product, returns updated list |
| DELETE | /products/:id   | Removes a product by ID, returns updated list |

## Project Structure
```
week4_ex02_vue_api_integration/
├── .gitignore
├── README.md
├── server/
│   ├── .env
│   ├── .gitignore
│   ├── package.json
│   └── server.js
└── client/
    ├── index.html
    ├── package.json
    ├── vite.config.js
    └── src/
        ├── main.js
        ├── App.vue
        └── components/
            └── ProductList.vue
```

## Screenshots
*Add screenshots of the running application here.*

## Author
Shuaib Darries, Life Choices Academy YouthCode Off-Site, Cohort 2.
