# Data Exploration System
This project contains template for the user interface with mocked data. This template can be extended and configured as needed. User Interface is built using [AdminLTE template](https://adminlte.io/themes/AdminLTE/index2.html) template, [Tabulator](http://tabulator.info/) for showing and exploring data in data grid and [Chart.js](https://www.chartjs.org/) for graphs.

Client Side code is written in Vanilla JavaScript with HTML and CSS and, server side code is written in Django (5.0) framework.

## How to run

1. Ensure that you have Python 3 installed on your system. You can download it from [here](https://www.python.org/downloads/). This web app was tested with Python 3.10.13.

2. Install Django and other required packages. Navigate to the project directory in your terminal and run the following command:
    ```
    pip install -r requirements.txt
    ```
3. Make sure you're in the same directory as manage.py and run the following command to run the server:
    ```
    python manage.py runserver
    ```
    Navigate to ```localhost:8000/login``` in web browser.

4. You need to create a user in the system to login. You can create user either by using [create_test_user](https://github.com/muneeb706/data-exploration-system/blob/master/data_exploration_system/urls.py#L44) API or you can use superuser (```python manage.py createsuperuser```)

## How to run tests (end to end)

[Cypress](https://www.cypress.io/) is used for end to end testing (All functionalities are not tested, purpose was to demo how cypress can be used).

Follow these steps to run the tests:

1. Ensure that you have Node.js and npm installed. If not, you can download Node.js and npm from [here](https://nodejs.org/en/download/). This will install both Node.js and npm.

2. Install Cypress and [start-server-and-test](https://www.npmjs.com/package/start-server-and-test) via [package.json](https://github.com/muneeb706/data-exploration-system/blob/master/package.json).
    ```
    npm install
    ```
3. Run test
    ```
    npm test
    ```
    It will run django server and cypress tests.




## Functionalites of the system with screenshots

### Log In

![Log In](https://github.com/muneeb706/data-exploration-system/blob/master/docs/login.png)

### Dashboard

Dashboard shows the count of key entities and an area graph for a selected element within an entity for a specific year range.

![Dashboard](https://github.com/muneeb706/data-exploration-system/blob/master/docs/dashboard.png)

### Data Explorer

This section allows users to navigate and download data from a selected data source. Users first select a data source type - either 'Table' or 'Query'. The dropdown options for the data source name will update based on this selection. After choosing a table or query, users can view the corresponding data and download the currently displayed page.

![Data Explorer](https://github.com/muneeb706/data-exploration-system/blob/master/docs/data-explorer.png)

The grid includes filter boxes under each column header. Numeric columns have two boxes for minimum and maximum values.

The grid features a refresh button to clear filters and restore initial data, and a download button to save the current grid data as a CSV file named '[Table Name]-[page number]'. Page numbers at the grid's bottom allow navigation between data pages. The current page number is highlighted in red.

### Data Downloader

The data downloader page mirrors the data explorer, but downloads all data from the selected Table/Query. If the data exceeds 100k records, only the first 100k are downloaded.

![Data Downloader](https://github.com/muneeb706/data-exploration-system/blob/master/docs/data-downloader.png)

### Log Out
To Log Out of the system, the user needs to click the arrow button on the top right corner.
