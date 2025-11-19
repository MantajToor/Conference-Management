# Conference Management System

A web-based conference management system built with PHP and MySQL. This application allows managing conference attendees, rooms, schedules, sponsorships, and financial tracking.

## Features

- **Attendee Management**: Track students, professionals, and sponsors
- **Room Assignments**: Manage room allocations for students
- **Schedule Management**: View and update conference sessions
- **Sponsorship Tracking**: Manage sponsoring companies and job postings
- **Financial Overview**: Calculate earnings from fees and sponsorships
- **Subcommittee Management**: Organize conference committees and members

## Requirements

- XAMPP (or similar Apache + MySQL + PHP environment)
- PHP 7.0 or higher
- MySQL 5.6 or higher

## Installation

1. Clone this repository into your XAMPP `htdocs` directory:
   ```bash
   cd /Applications/XAMPP/htdocs/  # On Mac
   # OR
   cd C:\xampp\htdocs\  # On Windows
   
   git clone <your-repo-url> "Conference Management"
   ```

2. Start Apache and MySQL services in XAMPP

3. Set up the database:
   - Open phpMyAdmin: `http://localhost/phpmyadmin`
   - Click on the **SQL** tab
   - Copy the contents of `conferenceDB2.ddl`
   - Paste into the SQL query box and click **Go**

4. Test the database connection:
   - Navigate to `http://localhost/Conference%20Management/test_database.php`
   - Verify all tables show green checkmarks

5. Access the application:
   - Main page: `http://localhost/Conference%20Management/conference.php`

## Testing

See `TESTING_GUIDE.md` for comprehensive testing instructions.

## Database Schema

The application uses the following main tables:
- `attendee` - Conference attendees
- `student` - Student attendees with room assignments
- `professional` - Professional attendees
- `sponsor` - Sponsor attendees linked to companies
- `speaker` - Speakers for sessions
- `room` - Available rooms
- `session` - Conference sessions/talks
- `company` - Sponsoring companies
- `jobAD` - Job postings from companies
- `subcommittee` - Conference committees
- `member` - Committee members

## Usage

### Adding Attendees
1. Navigate to **Attendees** page
2. Fill in the form with attendee details
3. Select if they are a student
4. Assign room number (for students only)
5. Click **Add Attendee**

### Managing Sponsors
1. Navigate to **Company** page
2. View current sponsors and their levels
3. Add new sponsors using the form
4. View job postings from companies

### Scheduling Sessions
1. Navigate to **Schedule** page
2. View all scheduled sessions
3. Search by date
4. Update session details as needed

## Security Notes

**Important**: This is a development/educational project. Before deploying to production:
- Change the default database credentials
- Implement proper user authentication
- Add CSRF protection
- Sanitize all user inputs
- Use prepared statements (already partially implemented)
- Add SSL/HTTPS
- Implement proper error handling

## File Structure

```
Conference Management/
├── conference.php           # Main landing page
├── connectdb.php           # Database connection
├── navbar.php              # Navigation bar component
├── conferenceDB2.ddl       # Database schema and initial data
├── conferenceimage.jpeg    # Conference image
├── test_database.php       # Database testing utility
├── TESTING_GUIDE.md       # Comprehensive testing guide
└── PAGES/
    ├── attendees.php      # Manage attendees
    ├── earnings.php       # View financial summary
    ├── rooms.php          # Room assignments
    ├── schedule.php       # Session scheduling
    ├── sponsorships.php   # Company/sponsor management
    └── subcommittee.php   # Committee management
```

## Contributing

Feel free to submit issues and enhancement requests!

## License

This project is for educational purposes.

## Author

Created as part of a conference management system project.

