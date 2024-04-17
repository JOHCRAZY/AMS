

<h1 align="center">Assignment Management System</h1>
<h1 align="center">📖</h1>




## Overview
The assignment management system is a web-based platform designed to facilitate the management of assignments, and coursework for a university. The system caters to students, instructors, and administrators, providing functionalities for assignment creation, submission, grading, and overall management.

## User Roles
1. **Student**
2. **Instructor**
3. **Administrator**

## Functional Requirements

### General Features
- User Authentication: Users should be able to log in securely to access the system.
- User Roles and Permissions: Different user roles should have appropriate permissions.
- Dashboard: Each user role should have a customized dashboard displaying relevant information.
- Communication Tools: Integrated messaging or discussion forums for communication between users.
- Notifications: Automated reminders for upcoming assignment deadlines and other important events.

### Student Features
- View Assignments: Students should be able to view upcoming assignments along with due dates and instructions.
- Submit Assignments: Students should be able to submit assignments electronically.
- View Grades and Feedback: Students should be able to view their grades and feedback provided by instructors or TAs.
- Course Enrollment: Students should be able to enroll in courses and view their course schedule.


### Instructor Features
- Create Assignments: Instructors should be able to create assignments, set due dates, and specify instructions.
- Manage Courses: Instructors should be able to manage course offerings, enrollments, and schedules.
- Grade Assignments: Instructors should be able to review and grade assignments submitted by students.
- View Analytics: Instructors should have access to analytics and reports on student performance.

### Administrator Features
- User Management: Administrators should be able to manage user accounts, roles, and permissions.
- System Configuration: Administrators should be able to configure system settings and parameters.
- Data Management: Administrators should have access to data management functionalities such as backups and restores.
- System Maintenance: Administrators should be able to perform routine maintenance tasks on the system.

## Non-Functional Requirements
- **Security**: The system should ensure data security and integrity, including secure authentication and data encryption.
- **Scalability**: The system should be scalable to accommodate a growing number of users and assignments.
- **Usability**: The system should be intuitive and user-friendly, with clear navigation and minimal learning curve.
- **Performance**: The system should have fast response times and be able to handle concurrent user activity efficiently.
- **Compatibility**: The system should be compatible with modern web browsers and devices.

## Constraints

- The system should be developed using [Yii](https://www.yiiframework.com/) framework version 2.X.X.
- The system should be deployed locally [localhost](http://localhost) during development phase.
- All code must adhere to Yii's coding standards as specified in the [Yii Documentation](https://github.com/yiisoft/yii2/blob/)


DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources

## Assumptions
- Users have access to a reliable internet connection.
- Users have basic computer literacy skills.
- Instructors and TAs have expertise in the subjects they are teaching.
- The system will be used primarily within the university's intranet.



Student.
------- 
- Username: The unique identifier for the student's - account.
- Email: The email address of the student for communication purposes.
- Password: Securely stored hashed password for account authentication.
- Full Name: The full name of the student.
- Date of Birth: The date of birth of the student.
- Address: The residential address of the student.
- Contact Number: The phone number of the student.
- Enrollment Date: The date when the student enrolled in the university.
- Course Enrollments: The courses in which the student is currently enrolled.
- Assignment Submissions: The assignments submitted by the student.
- Grades: The grades achieved by the student in various assignments and courses.
- Academic Advisor: The assigned academic advisor for the student.

-------------------


Administrator.
-------------
- Username: The unique identifier for the administrator's account.
- Email: The email address of the administrator for communication purposes.
- Password: Securely stored hashed password for account authentication.
- Full Name: The full name of the administrator.
- Date of Birth: The date of birth of the administrator.
- Address: The residential address of the administrator.
- Contact Number: The phone number of the administrator.
- System Settings: Access to configure system settings and parameters.
- User Management: Ability to create, modify, and delete user accounts.
- Course Management: Management of course offerings, schedules, and assignments.
- Data Analytics: Access to analytics and reports for system performance and user activity.
- System Maintenance: Tasks related to system maintenance, backups, and updates.
---