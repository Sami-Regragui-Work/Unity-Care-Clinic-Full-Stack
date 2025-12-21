# 🏥 Unity Care Clinic – Full Stack Dashboard

A modern, full-stack clinic management system built with PHP, MySQL, Tailwind CSS, and jQuery. Features dynamic CRUD operations, reusable modals, and a clean, responsive interface for managing patients, doctors, and departments.

## 📑 Table of Contents

-   [Project Overview](#project-overview)
-   [Tech Stack](#tech-stack)
-   [Project Structure](#project-structure)
-   [Installation & Setup](#installation-setup)
-   [Database Schema](#database-schema)
-   [Features Breakdown](#features-breakdown)
-   [Available Scripts](#available-scripts)
-   [Use Case Diagram](#use-case-diagram)
-   [License](#license)
-   [Contributing](#contributing)

## <h2 id="project-overview">🎯 Project Overview</h2>

This mini-project demonstrates a complete clinic management workflow with a focus on clean architecture, reusable components, and modern UI/UX patterns. Built as a learning exercise and portfolio piece showcasing full-stack PHP development with contemporary frontend tooling.

**Key Features:**

-   Generic CRUD operations for multiple entities using shared code
-   Modal-based forms with AJAX submissions (no page reloads)
-   Real-time search and pagination
-   Dashboard with statistics and charts
-   Dark mode support
-   Responsive design (mobile/desktop)

## <h2 id="tech-stack">🛠️ Tech Stack</h2>

**Frontend:**

-   Tailwind CSS v4 (utility-first styling)
-   jQuery (DOM manipulation & AJAX)
-   Chart.js (data visualization)
-   Custom CSS utilities

**Backend:**

-   PHP (procedural, MySQLi)
-   MySQL database
-   JSON API endpoints

**Development Tools:**

-   Node.js & npm
-   Tailwind CLI
-   Browsersync (live reload)
-   Concurrently (parallel scripts)

## <h2 id="project-structure">📁 Project Structure</h2>

```
.
├── assets/
│   ├── conf/
│   │   ├── bs-config.js          # Browsersync configuration
│   │   └── tailwind.config.js    # Tailwind paths & theme
│   ├── css/
│   │   ├── custom.css            # Custom utilities & overrides
│   │   └── tw.css                # Generated Tailwind output
│   ├── js/
│   │   ├── crud.js               # Generic CRUD logic & modals
│   │   ├── dashboard.js          # Dashboard chart rendering
│   │   └── sidebar.js            # Navigation & section loading
│   ├── media/
│   │   ├── ERD_UCCV1.png         # Database entity-relationship diagram
│   │   ├── USECASE_UCCV1.png     # Use case diagram
│   │   └── usecase.wsd           # PlantUML source
│   ├── php/
│   │   ├── action/
│   │   │   ├── addRow.php        # INSERT + return HTML row
│   │   │   ├── deleteRow.php     # DELETE by ID
│   │   │   └── editRow.php       # UPDATE by ID
│   │   ├── component/
│   │   │   └── sidebar.php       # Reusable navigation
│   │   ├── modals/
│   │   │   └── addForms.php      # Modal forms for all entities
│   │   ├── section/
│   │   │   ├── dashboard.php     # Dashboard content
│   │   │   └── dynamicTable.php  # Generic table renderer
│   │   └── dbLink.php            # Database connection
│   └── sql/
│       ├── ddl.sql               # Database schema
│       └── dml.sql               # Seed data (15 depts, 25 doctors, 30 patients)
├── index.php                      # Application entry point
├── package.json                   # NPM scripts & dependencies
└── README.md
```

## <h2 id="installation-setup">🚀 Installation & Setup</h2>

1. **Clone the repository**

    ```bash
    git clone <repository-url>
    cd unity-care-clinic
    ```

2. **Install dependencies**

    ```bash
    npm install
    ```

3. **Database setup**

    - Create a MySQL database named `UCCV1`
    - Import the schema: `mysql -u username -p UCCV1 < assets/sql/ddl.sql`
    - Import seed data: `mysql -u username -p UCCV1 < assets/sql/dml.sql`

4. **Configure database connection**

    - Edit `assets/php/dbLink.php`
    - Update host, username, password, and database name

5. **Start development server**

    ```bash
    npm run bstw
    ```

    This runs Tailwind watch mode and Browsersync concurrently

6. **Access the application**
    - Open `http://localhost:3000` (or your configured port)
    - Or serve via XAMPP/Laragon and navigate to `index.php`

## <h2 id="database-schema">📊 Database Schema</h2>

The system uses three main tables with relationships:

-   **patients**: Patient records (name, gender, DOB, contact info, address)
-   **doctors**: Doctor profiles (name, specialization, contact, department)
-   **departments**: Clinic departments (name, location, description)

**Relationships:**

-   `doctors.department_id` → `departments.department_id` (Foreign Key)

**View the complete ERD:** `assets/media/ERD_UCCV1.png`

## <h2 id="features-breakdown">🎨 Features Breakdown</h2>

**Dashboard:**

-   Overview statistics (patient/doctor/department counts)
-   Interactive bar chart visualization
-   Quick navigation to entity management

**CRUD Operations:**

-   Add, edit, delete for all entities
-   Real-time table updates without page reload
-   Form validation and error handling

**Search & Pagination:**

-   Live search across all table columns
-   Paginated results (50 per page)
-   Maintains search state during pagination

**UI/UX:**

-   Modal-based forms for better user flow
-   Responsive design (mobile sidebar becomes top bar)
-   Dark mode support
-   Smooth transitions and hover effects

## <h2 id="available-scripts">📜 Available Scripts</h2>

```bash
npm run tw      # Watch Tailwind CSS changes
npm run bs      # Start Browsersync server
npm run bstw    # Run both Tailwind & Browsersync
```

## <h2 id="use-case-diagram">🗺️ Use Case Diagram</h2>

**View the complete use case diagram:** `assets/media/USECASE_UCCV1.png`

**Main Actor:** Admin

**Primary Use Cases:**

-   Log in (support planned)
-   Manage Patients (CRUD)
-   Manage Doctors (CRUD)
-   Manage Departments (CRUD)
-   View Dashboard Statistics
-   Change Language (EN/FR/AR support planned)

## <h2 id="license">📝 License</h2>

This project is open source and available for educational purposes.

## <h2 id="contributing">🤝 Contributing</h2>

This is a learning project, but suggestions and improvements are welcome! Feel free to open an issue or submit a pull request.

---

**Note:** Database credentials in `dbLink.php` should be secured using environment variables in production environments.
