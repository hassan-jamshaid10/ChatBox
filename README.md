# ChatBox App

ChatBox is a simple messaging web application that allows users to register, log in, and communicate with each other. It features real-time-like messaging capabilities without using WebSockets, with support for emojis and image uploads.

## Pages

- **Home Landing Page**: Introduction and navigation to login or signup.
- **Login**: User authentication page to access the app.
- **Signup**: Registration page for new users to create an account.
- **Chat Page**: Messaging interface where users can send and receive messages.
- **User Profile Page**: Profile details of the user including username and settings.

## Functionality

- **Send Messages Locally**: Messages are sent and displayed in the chat interface in real-time-like behavior.
- **Emojis Support**: Users can send emojis as part of the messages.
- **Send Images**: Users can attach and send images as part of their messages.
- **Login/Signup**: Users can create an account and log in to their profile.
  
## Technologies

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **AJAX**: Used for dynamic content loading without refreshing the page.
- **Database**: MySQL for storing user data and messages.

## Database Structure

The app uses MySQL to store user and message data. Below are the primary tables:

- **Users Table**: Stores user information (username, email, password).
- **Messages Table**: Stores messages with references to the user who sent them and the receiver.
- **Images Table**: Stores the file paths of images uploaded by users.

### Sample Database Schema

#### Users Table

| Column        | Type        | Description                |
|---------------|-------------|----------------------------|
| `id`          | INT         | Primary Key, Auto-increment |
| `username`    | VARCHAR(255) | Unique, not null            |
| `email`       | VARCHAR(255) | Unique, not null            |
| `password`    | VARCHAR(255) | Hashed password             |
| `created_at`  | TIMESTAMP   | Timestamp of account creation |

#### Messages Table

| Column        | Type        | Description                           |
|---------------|-------------|---------------------------------------|
| `id`          | INT         | Primary Key, Auto-increment           |
| `sender_id`   | INT         | Foreign Key (references `Users.id`)   |
| `receiver_id` | INT         | Foreign Key (references `Users.id`)   |
| `message`     | TEXT        | Message content                       |
| `emoji`       | VARCHAR(255) | Emoji used (optional)                 |
| `images`  | VARCHAR(255) | Path to the uploaded image (optional) |
| `created_at`  | TIMESTAMP   | Timestamp of message sent             |


## Contributions

Contributions to the project are welcome! To contribute:

1. Fork this repository.
2. Create a new branch for your feature (`git checkout -b feature-name`).
3. Commit your changes (`git commit -am 'Add new feature'`).
4. Push to the branch (`git push origin feature-name`).
5. Create a new Pull Request with a description of the changes.

Please make sure to follow the coding standards and write meaningful commit messages.

## Queries

For any queries, feel free to open an issue or contact the project owner directly.
hjanshaid81@gmail.com
hassan.jamshaid@ieee.org
---

Happy coding! 🎉
