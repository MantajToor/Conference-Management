# Conference Management System - Testing Guide

## Prerequisites
- XAMPP must be installed and running
- Apache and MySQL services must be started in XAMPP
- Project folder must be in the `htdocs` directory of XAMPP

## Step 1: Database Setup

### Option A: Using the Test Script (Recommended)
1. Open your browser and navigate to: `http://localhost/Conference%20Management/test_database.php`
2. This will check if your database is set up correctly
3. If the database doesn't exist, follow the on-screen instructions

### Option B: Manual Setup via phpMyAdmin
1. Open phpMyAdmin: `http://localhost/phpmyadmin`
2. Click on the **SQL** tab at the top
3. Open the `conferenceDB2.ddl` file in a text editor
4. Copy ALL the contents
5. Paste into the SQL query box in phpMyAdmin
6. Click **Go**
7. You should see messages indicating successful table creation

## Step 2: Test Main Page

**URL:** `http://localhost/Conference%20Management/conference.php`

**Expected Results:**
- ✓ Page loads without errors
- ✓ Navigation bar appears at the top with all page links
- ✓ "Welcome to the conference management web app!" heading displays
- ✓ Conference image displays
- ✓ No database connection errors

---

## Step 3: Test Individual Pages

### 3.1 Attendees Page
**URL:** `http://localhost/Conference%20Management/PAGES/attendees.php`

**Features to Test:**

1. **View Student List**
   - Should display: Alice Smith, Bob Jones, Cathy Lee, Dan Brown, Eva Green, Frank White

2. **View Professional List**
   - Should display: Bob Jones, Dan Brown, Frank White

3. **View Sponsor List**
   - Should display: Alice Smith, Bob Jones, Cathy Lee, Eva Green

4. **Add New Attendee**
   - Fill in the form:
     - First Name: `John`
     - Last Name: `Test`
     - Fee: `150.00`
     - Is student: `Yes`
     - Room number: `101`
   - Click "Add Attendee"
   - Expected: Success message "Attendee has been added"
   - Refresh page to verify John Test appears in the student list

---

### 3.2 Earnings Page
**URL:** `http://localhost/Conference%20Management/PAGES/earnings.php`

**Features to Test:**

1. **View Earnings Summary**
   - Should display total fees from attendees
   - Should display total sponsorship earnings
   - Should display combined total earnings
   
   **Expected Initial Values:**
   - Total fees: $750.00
   - Total sponsorships: $19,000.00 (1 Bronze + 2 Silver + 1 Gold + 1 Platinum)
   - Total earnings: $19,750.00

---

### 3.3 Sponsorships/Company Page
**URL:** `http://localhost/Conference%20Management/PAGES/sponsorships.php`

**Features to Test:**

1. **View Sponsor Companies**
   - Should display companies: meta, amazon, apple, microsoft, google, TD
   - Each with their sponsorship level

2. **View Job Postings by Company**
   - Select a company from dropdown (e.g., "meta")
   - Click "Show Jobs"
   - Should display job titles for that company
   - Example for meta: Software Engineer, HR Specialist

3. **Add New Sponsoring Company**
   - Company name: `Tesla`
   - Sponsorship level: `Gold`
   - Click "Add Company"
   - Expected: Success message
   - Refresh to see Tesla in the sponsor list

4. **Delete Company** (Be careful - this deletes associated attendees!)
   - Enter company name: `Tesla`
   - Click "Delete"
   - Expected: Success message about deletion
   - Company and associated attendees removed

---

### 3.4 Schedule Page
**URL:** `http://localhost/Conference%20Management/PAGES/schedule.php`

**Features to Test:**

1. **View All Sessions**
   - Should display 3 sessions:
     - Room A, 2025-03-10, 09:00:00 to 10:30:00
     - Room B, 2025-03-11, 11:00:00 to 12:30:00
     - Room C, 2025-03-12, 14:00:00 to 15:30:00

2. **Search Schedule by Date**
   - Enter date: `2025-03-10`
   - Click "Submit"
   - Should display only sessions on that date

3. **Update a Session**
   - Select a session from the dropdown
   - Enter new details:
     - New Date: `2025-03-15`
     - New Start Time: `10:00:00`
     - New End Time: `11:30:00`
     - New Location: `Room D`
   - Click "Update Session"
   - Expected: Success message
   - Session should be updated in the list

---

### 3.5 Rooms Page
**URL:** `http://localhost/Conference%20Management/PAGES/rooms.php`

**Features to Test:**

1. **Check Room Occupancy**
   - Enter room number: `101`
   - Click "Submit"
   - Should display students assigned to that room
   - Example: Room 101 should show Alice Smith

2. **Test Different Rooms**
   - Try rooms: 101, 102, 103, 104, 105, 106
   - Each should show the assigned student(s)

---

### 3.6 Subcommittee Page
**URL:** `http://localhost/Conference%20Management/PAGES/subcommittee.php`

**Features to Test:**

1. **View Subcommittee Members**
   - Select subcommittee from dropdown (e.g., "Finance")
   - Click "Show Members"
   - Should display member name
   - Example: Finance should show John Doe

2. **Test All Subcommittees**
   - Finance → John Doe
   - Marketing → Jane Smith
   - Operations → Emily Davis
   - Logistics → Michael Brown
   - Sponsorship → Sarah Wilson
   - IT → Chris Taylor

---

## Step 4: Navigation Testing

Test all navigation links in the navbar:
- ✓ Home link returns to main conference.php
- ✓ All page links work correctly
- ✓ Navigation is consistent across all pages

---

## Common Issues and Solutions

### Issue: "Database connection failed"
**Solution:** 
- Ensure MySQL service is running in XAMPP
- Run the test_database.php script
- Check that conferenceDB2 database exists in phpMyAdmin

### Issue: "Table doesn't exist" errors
**Solution:**
- Database not set up correctly
- Run the conferenceDB2.ddl script in phpMyAdmin

### Issue: Pages return 404 Not Found
**Solution:**
- Ensure project folder is in XAMPP's htdocs directory
- Check that folder name matches the URL path
- Verify Apache service is running

### Issue: Navigation links don't work
**Solution:**
- Already fixed! The navbar.php has been updated with correct paths

### Issue: Images don't display
**Solution:**
- Ensure conferenceimage.jpeg exists in the main project folder
- Check file permissions

---

## Expected Database Schema

Your database should have these tables with data:
- **attendee** (6 rows)
- **room** (6 rows)
- **student** (6 rows)
- **professional** (3 rows)
- **sponsor** (4 rows)
- **company** (6 rows)
- **jobAD** (6 rows)
- **session** (3 rows)
- **subcommittee** (6 rows)
- **member** (6 rows)
- **memberof** (6 rows)
- **speaker** (3 rows)

---

## Testing Checklist

- [ ] Database setup completed
- [ ] test_database.php shows all green checkmarks
- [ ] Main conference.php page loads correctly
- [ ] Attendees page displays all lists
- [ ] Can add new attendee successfully
- [ ] Earnings page calculates totals correctly
- [ ] Sponsorships page shows companies and jobs
- [ ] Can add new company
- [ ] Schedule page shows all sessions
- [ ] Can search schedule by date
- [ ] Can update session
- [ ] Rooms page shows room occupancy
- [ ] Subcommittee page shows members
- [ ] All navigation links work
- [ ] No PHP errors or warnings display

---

## Next Steps After Testing

Once all tests pass:
1. Consider adding CSS styling for better visual appearance
2. Add form validation
3. Implement user authentication
4. Add more error handling
5. Consider security improvements (SQL injection prevention is partially done)

---

**Created:** November 19, 2025  
**Project:** Conference Management System  
**Environment:** XAMPP with PHP and MySQL

