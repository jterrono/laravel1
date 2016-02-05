Second: Applying
On a Homestead box:

x Start a fresh project using Laravel 5.1
x Map the project's domain to hello-james.dev
x Re-create the original project below with a couple of caveats:

Authentication must be done through the request header and use Middleware to validate
Requests should be validated using official Laravel Requests
x All migrations should be official Laravel migrations
All requests should be backed by PHPUnit tests


Tools

Postman (an extension for Chrome), might be your good friend while testing
Laravel Documentation
The Project
All responses should be JSON
All requests should be JSON
No need to build any UI
Description of Application

The application consists of users and products.

Users

Each user must have, but is not limited to:

ID
First Name
Last Name
Email (unique)
Please note:

These users are the only users that are able to make requests via the API.
User creation/maintenance is not done through the API (see Database section below).
Users can own many products
Products

Each product must have, but is not limited to:

ID
Name
Description
Price
Image
Database

MySQL
The user table should be seeded with five users
Tables should utilize foreign keys
Authentication

You must implement an authentication system so that the API knows which of the users is making the request. All requests should ensure that an authorized user is making the request. In the event of an unauthorized user, an error should be thrown with the appropriate status code.

Requests

The following requests should be implemented:

x- Add product
All fields required except ID and image
x- Update product
All fields required except image
x- Delete product
x- Get product
Upload product image
x- Get list of all products
Attach product to requesting user
Remove product from requesting user
List products attached to requesting user