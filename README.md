# Har Analyzer


This application relates to a project prepared in the course "Web Programming & Systems" in my undergraduate course and it was my first attempt at developing an application with front-end & back-end systems.

The general objective of the project is to develop a complete system for collecting, managing and analyzing crowdsourced information concerning HTTP traffic data. More precisely, internet traffic via HTTP can be recorded by any client, so that this data can be used later to analyze the behavior of a website. For this purpose, the HAR (HTTP ARchive) standard has been created, which defines a specific JSON structure (schema) for storing this data.

For the project were used :
- PHP
- HTML
- CSS
- JavaSccript
- MySQL

> Structure of the Database (ER, table schema)

![Εικόνα1](https://user-images.githubusercontent.com/45511638/141685989-903c6988-53c1-409d-8472-845210cf246f.png)

## Features

##### *User:*

- **Registration in the system.** The user registers and accesses the system by choosing a username, password and providing his email. The password must be at least 8 characters long and contain at least one capital letter, a number and a symbol (eg # $ * & @).

- **Upload data.** The user selects a HAR file from his computer. The file edited locally to delete sensitive data and then the user has two options: a) Upload it to the system or b) Save the edited file locally.

- **Profile management.** The user can change the username / password and see basic statistics for the data he has uploaded (date of last upload, number of registrations)

- **Data visualization.** The user can see on a map the locations of the IPs to which he has sent HTTP requests. Specifically, the map shows a heatmap that depicts the distribution of the number of records related to HTML, PHP, ASP, JSP (or pure domains, without path) web objects.

##### *Admin:*

The Administrator accesses the system with an appropriate username and password mechanism. Upon entering the system it has the following features.

- **Display of Basic Information.** The administrator sees relevant information on one page, in tables.

- **Analysis of response times to requests.** A configurable diagram with the average response time (Y axis) is displayed on each request per hour of the day [0-24] (X axis). The diagram can display filtered data.

- **HTTP header analysis.** The administrator sees relevant information on a page, in graphs depicting data related to the use of caches.

    All of the above graphs are configured by selecting the ISP.

- **Data visualization.** The administrator can see on a map the locations of the IPs to which he has sent HTTP requests. Specifically, a marker is displayed per IP, with lines connecting each user's city of origin with each icon. The thickness of the lines is adjusted according to the number of requests made to the specific IP, normalized to the maximum number made to the most popular IP.

## Use cases

https://user-images.githubusercontent.com/45511638/141688839-ff4ed536-e6f1-42de-ab8c-f6590a127d93.mp4


## License

Copyright © 2021 Gerasimos Katevas
