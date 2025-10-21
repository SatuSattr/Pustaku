# Productive Summative Assessment – XI RPL

## Web Programming: Library Management System

**Odd Semester**  
**Academic Year 2025/2026**

---

## 📘 Scenario

You are a **junior web developer** assigned to build a **web-based library management system**.  
This system has **two types of users**:

1. **Admin** — responsible for managing book data.
2. **Student** — can view the book list and borrow available books.

---

## ⚙️ Working Steps

### Access Rights

-   **Admin** can log in using a _username_ and _password_ to manage book data (CRUD — Create, Read, Update, Delete).
-   **Students** can only view the list of books that are available for borrowing according to stock availability.

---

## 🧩 Required Features

### 1. Login – Logout

-   Display a login form for Admin/Student.
-   Authenticate and redirect to the **Admin dashboard**.
-   Authenticate and redirect to the **Student page**.

---

### 2. Admin Features

#### Book Management

The Admin can fully manage the book inventory with the following details:

-   Display a **book list table** containing:

    -   Number
    -   Book title
    -   Category
    -   Book image
    -   Quantity
    -   Book description

-   Implement full **CRUD features** for book management:

    -   **Add book form** page
    -   **Edit book form** page
    -   **Delete button** for removing a book

-   Provide a page for **borrowed books list** displayed as a table, containing:
    -   Number
    -   Borrower’s name
    -   Book title
    -   Quantity
    -   Book status (_Processing_, _Borrowed_, _Returned_)
    -   Borrow date
    -   Return date
    -   Action button

---

### 3. Student Features

#### Borrowing Books

-   Students can view the **available books** displayed as **cards**, each showing complete information and details.
-   When a book card is clicked, it opens the **borrow form page** that requires:

    -   Borrower’s name
    -   Book title
    -   Quantity
    -   Borrow date
    -   Return date

-   The form page should also show detailed images and information about the book, similar to **Tokopedia-style project designs**.

---

## 🗄️ Database

-   Create a database named **`db_perpustakaan`**
-   Create the necessary tables to store data for:
    -   **Admin**
    -   **Regular users (Students)**
    -   **Books**
    -   **Borrowing form**

---

## 🧮 Project Assessment

As a **junior web developer**, you are required to build a **book inventory management website**.  
The client expects the following criteria to be met:

### ✅ Do

-   Develop a website where **each feature works properly**.
-   Design an **attractive and creative layout** — you may look for inspiration on **Pinterest** or other design sources.

### ❌ Don’t

-   Do **not** use Laravel’s **default template layout**.
-   Do **not** add confirmation dialogs when using the delete feature.

---

## 💻 Technical Requirements

This project **must** be developed using the following stack and rules:

-   **Framework:** Laravel **12**
-   **Authentication:** Laravel **Breeze**
-   **Database:** **SQLite** (for simplicity and portability)
-   **Styling:** **TailwindCSS**

> ⚠️ **Important:**  
> Use TailwindCSS as the main styling framework.  
> Avoid overusing pre-built components — only use component structures for the **main layout**.  
> Other sections (forms, tables, cards, etc.) should be built manually using native Tailwind utilities.

---
