# customers
The project consists of a web-based application that manages a list of customers. The application allows users to add new customers, edit existing ones, view the list of customers, and search for a specific customer.

The "Add Customer" page includes a form that allows the user to input customer details such as name, address, telephone number, and email address. The user must provide a name and email address to add a new customer. Upon successful submission of the form, the application saves the new customer's details to the database and displays a success message.

The "Edit Customer" page is similar to the "Add Customer" page, except that it pre-populates the form with the existing customer's details. The user can modify the details and save the changes by submitting the form. The application updates the customer's details in the database and displays a success message.

The "Customer List" page displays a table of all the customers in the database. The table includes the customer's name, address, telephone number, and email address, and it also provides links to edit or delete each customer.

The "Search Customer" page allows the user to search for a specific customer by name or email address. Upon successful submission of the search form, the application displays a table of all the customers that match the search criteria. If no customers match the search criteria, the application displays a message indicating that no customers were found.

The application uses PHP for server-side processing, MySQL for data storage, and Bootstrap for the user interface. The code is organized into separate files for each page and includes comments to aid in understanding the functionality of each section.