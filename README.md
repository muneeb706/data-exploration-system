# Data Exploration System
Analyzing a large number of records in the database is a daunting task. Especially, Researchers having little or no background in database management systems (DBMS) find it difficult to study and analyze the large amount of data stored in such systems. They spend most of their time dealing with the technicalities of underlying database systems instead of utilizing this time for productive work i.e. research. To improve the productivity of researchers a Data Exploration System is developed. 

This system gives access to the data in the configured database through an interactive and easy to use User Interface. With the help of this interface, researchers can navigate, filter, and download the data as needed. Along with the exploration, this system also enables researchers to view the summary statistics of important elements in the data.

This project contains template for the user interface with mocked data. This template can be extended and configured as needed. User Interface is built using [AdminLTE template](https://adminlte.io/themes/AdminLTE/index2.html) and [Tabulator](http://tabulator.info/) is used for showing and exploring data in data grid. 

Client Side code is written in [JavaScript](https://www.javascript.com/) along with HTML and CSS and for sending mocked data, server side code is written in [PHP](https://www.php.net/) (7.3.x). Server side code for connecting with the database and querying database is in the api folder.

## Functionalites of the system with screenshots

### Log In

If the user is not already logged into the system then the system will ask the user for the credentials. For running this template you can type anything in username and password for signing in.

![Log In](https://github.com/muneeb706/data-exploration-system/blob/master/docs/login.PNG)

### Dashboard

On this section, the system displays the total number of important entities in the database. Along with this, it displays the area graph for important element in given entity in a given year range.

![Dashboard](https://github.com/muneeb706/data-exploration-system/blob/master/docs/dashboard.PNG)

### Data Explorer

On this section, the system will allow the user to navigate the data from the selected data source and the user will also be able to download the data of the page that is currently being displayed. For the navigation of the data, first, the user has to select the type of data source. Table and Query are two types of the data source in this template which can be updated as needed. Options in the dropdown for the name of the data source will be changed according to the selected value in the dropdown for the type of data source and the user has to select a value for the type of data source to view the options for the name of the data source. After selecting the table / query option, the user will be able to see the list of tables / queries as options in the dropdown for the name of the data source.

![Data Explorer Data Source Selection Tool](https://github.com/muneeb706/data-exploration-system/blob/master/docs/data-explorer-selection-tool.PNG)

After selecting the desired table / query option (data source) from the dropdown and clicking the green button with a tick mark, the system will display the data accordingly.

![Data Explorer Data Grid](https://github.com/muneeb706/data-exploration-system/blob/master/docs/data-explorer-data-grid.PNG)

In the grid, there are text boxes under the heading of each column/ attribute. These text boxes are for filtering the data with a given text/number for desired columns. A column with numeric entries will have two text boxes, one for the minimum value and another for the maximum value. In this template data filtering functionality will not work as you have to write database query in the server side for filtering. You can do that on your own as needed.

On top of the grid, there is a yellow button with a recycle icon for refreshing the data. On clicking this data, all of the values in the filter text boxes will be cleared and all of the data without any filter will be displayed as it was displayed first. On the left side of this button, there is the green button with a file icon to download the data that is currently being displayed in the grid. If the user clicks the download button then the system will download the CSV file with the data. The name of the file will be [Table Name]-[page number]. If the user wants to download the filtered data then a similar process will be followed after the filtering process. At the bottom of the grid, a list of numbers will be displayed. These are the page numbers that can be selected by the user to view the data on that page. In the above picture number 1 is highlighted in red which means currently data of page number 1 is being displayed. If the user wants to switch to page number 3, the user will have to click number 3 and it will be highlighted in red.

### Data Downloader

Everything in the data downloader page is similar to the data explorer with one difference. This difference is related to the download mechanism. In the data downloader, when the user clicks the download button all of the data in the selected Table / Query data source will be downloaded. If the selected Table / Query has more than 100k records then first 100k data will be downloaded. 

![Data Downloader Confirmation Dialogue](https://github.com/muneeb706/data-exploration-system/blob/master/docs/data-downloader-confirmation-dialog.PNG)

After clicking continue, the system will start to download the data and it will display the progress.

![Data Downloader Progress Indicator](https://github.com/muneeb706/data-exploration-system/blob/master/docs/data-downloader-progress-indicator.png)

### Log Out
To Log Out of the system, the user needs to click the arrow button on the top right corner.
