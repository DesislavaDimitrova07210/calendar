# Calendar Booking App

## Description

Laravel app for managing bookings with REST API and web interface. The project include the Service-Repository pattern, separate controllers for Web and API, migrations, validation, and Bootstrap-based simply design.

## Getting Started

1. Clone the repository:
   ```
   git clone https://github.com/DesislavaDimitrova07210/calendar.git
   ```
   
2. .env
   Copy .env.example to .env and set proper values for db:

   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=calendar
   DB_USERNAME=user
   DB_PASSWORD=userpass

3. Start with Docker Compose:

   cd /calendar/.docker
   ```
   docker-compose up --build
   ```
   - The app will be available at http://127.0.0.1:8081

   - All the necessary migrations would be run in container, you don't need to run them manually

4. Access the API:
   - Example:  
     ```
     curl http://127.0.0.1:8081/api/bookings
     ```

## Example API Requests

- **List all bookings:**  
  `GET /api/bookings`
- **Get booking details:**  
  `GET /api/bookings/{id}`
- **Create booking:**  
  `POST /api/bookings`
- **Update booking:**  
  `PUT /api/bookings/{id}`
- **Delete booking:**  
  `DELETE /api/bookings/{id}`
